<?php

namespace App\Http\Controllers\Security;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuditTrailController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', config('audit.implementation'));

        $sub = 'Audit trail log';

        return view('security.audit-trail.index', ['sub' => $sub]);
    }

    /**
     * Handle the incoming request.
     */
    public function show(Request $request, string $uuid)
    {
        $audit = config('audit.implementation')::whereUuid($uuid)->firstOrFail();

        $this->authorize('view', $audit);

        $sub = 'Audit trail details';

        return view('security.audit-trail.show', ['audit' => $audit, 'sub' => $sub]);
    }
}
