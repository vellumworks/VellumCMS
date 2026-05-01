<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use App\Models\Organisation;
use App\Models\User;
use App\Services\CharityCommissionService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function __construct(private CharityCommissionService $charityCommission) {}

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'first_name'     => ['required', 'string', 'max:100'],
            'last_name'      => ['required', 'string', 'max:100'],
            'email'          => ['required', 'email', 'max:255', 'unique:users,email'],
            'org_name'       => ['required', 'string', 'max:255'],
            'org_type'       => ['required', 'in:registered-charity,nonprofit,cic,grassroots'],
            'charity_number' => ['nullable', 'string', 'max:20'],
            'password'       => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $charityNumber = filled($validated['charity_number'])
            ? preg_replace('/\D/', '', $validated['charity_number'])
            : null;

        // Determine verification status
        $status = 'pending';
        if ($charityNumber && $validated['org_type'] === 'registered-charity') {
            $status = $this->charityCommission->verify($charityNumber)
                ? 'verified'
                : 'pending'; // API said no — fall to manual review
        }

        $slug = $this->uniqueSlug($validated['org_name']);

        DB::transaction(function () use ($validated, $charityNumber, $slug, $status, &$user) {
            $org = Organisation::create([
                'name'           => $validated['org_name'],
                'slug'           => $slug,
                'charity_number' => $charityNumber,
                'org_type'       => $validated['org_type'],
                'status'         => $status,
            ]);

            $user = User::create([
                'organisation_id' => $org->id,
                'first_name'      => $validated['first_name'],
                'last_name'       => $validated['last_name'],
                'email'           => $validated['email'],
                'password'        => $validated['password'],
                'role'            => 'owner',
                'status'          => 'active',
            ]);

            AuditLog::record('org.registered', $org->id, $user->id, [
                'org_type'       => $validated['org_type'],
                'auto_verified'  => $status === 'verified',
            ]);
        });

        Auth::login($user);

        try {
            $user->sendEmailVerificationNotification();
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::warning('Verification email failed', [
                'user'  => $user->id,
                'error' => $e->getMessage(),
            ]);
        }

        if ($status === 'verified') {
            return redirect()->route('dashboard')
                ->with('status', 'Account created! Your charity has been verified. Please confirm your email address.');
        }

        return redirect()->route('pending')
            ->with('registered', true);
    }

    private function uniqueSlug(string $name): string
    {
        $base = Str::slug($name);
        $slug = $base;
        $i    = 2;

        while (Organisation::where('slug', $slug)->exists()) {
            $slug = "{$base}-{$i}";
            $i++;
        }

        return $slug;
    }
}
