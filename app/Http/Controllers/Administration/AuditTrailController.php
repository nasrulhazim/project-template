<?php

namespace App\Http\Controllers\Administration;

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

        return view('administration.audit-trail.index', compact('sub'));
    }

    /**
     * Handle the incoming request.
     */
    public function show(Request $request, string $uuid)
    {
        $audit = config('audit.implementation')::whereUuid($uuid)->firstOrFail();

        $this->authorize('view', $audit);

        $sub = 'Audit trail details';

        return view('administration.audit-trail.show', compact('audit', 'sub'));
    }
}
