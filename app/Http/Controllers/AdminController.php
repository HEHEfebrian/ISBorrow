<?php

namespace App\Http\Controllers;

use App\Models\BorrowRequest;
use App\Models\CatalogItem;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard(Request $request)
    {
        $catalogQuery = CatalogItem::query();

        if ($search = $request->query('catalog_search')) {
            $catalogQuery->where('name', 'like', "%{$search}%")
                ->orWhere('category', 'like', "%{$search}%")
                ->orWhere('location', 'like', "%{$search}%");
        }

        if ($category = $request->query('catalog_category')) {
            if ($category !== 'all') {
                $catalogQuery->where('category', $category);
            }
        }

        if ($availability = $request->query('catalog_availability')) {
            if ($availability !== 'all') {
                $operator = $availability === 'available' ? '>' : '<=';
                $catalogQuery->where('quantity', $operator, 0);
            }
        }

        if ($sort = $request->query('catalog_sort')) {
            match ($sort) {
                'name_asc' => $catalogQuery->orderBy('name', 'asc'),
                'name_desc' => $catalogQuery->orderBy('name', 'desc'),
                'quantity_asc' => $catalogQuery->orderBy('quantity', 'asc'),
                'quantity_desc' => $catalogQuery->orderBy('quantity', 'desc'),
                default => $catalogQuery->orderBy('name', 'asc'),
            };
        } else {
            $catalogQuery->orderBy('name', 'asc');
        }

        $catalogItems = $catalogQuery->paginate(12)->withQueryString();

        $requestQuery = BorrowRequest::with('catalogItem');

        if ($requestSearch = $request->query('request_search')) {
            $requestQuery->where(function ($query) use ($requestSearch) {
                $query->where('student_name', 'like', "%{$requestSearch}%")
                    ->orWhere('student_email', 'like', "%{$requestSearch}%")
                    ->orWhere('status', 'like', "%{$requestSearch}%")
                    ->orWhereHas('catalogItem', function ($itemQuery) use ($requestSearch) {
                        $itemQuery->where('name', 'like', "%{$requestSearch}%");
                    });
            });
        }

        if ($requestStatus = $request->query('request_status')) {
            if ($requestStatus !== 'all') {
                $requestQuery->where('status', $requestStatus);
            }
        }

        if ($requestSort = $request->query('request_sort')) {
            match ($requestSort) {
                'requested_at_asc' => $requestQuery->orderBy('requested_at', 'asc'),
                'requested_at_desc' => $requestQuery->orderBy('requested_at', 'desc'),
                'due_date_asc' => $requestQuery->orderBy('due_date', 'asc'),
                'due_date_desc' => $requestQuery->orderBy('due_date', 'desc'),
                default => $requestQuery->orderBy('requested_at', 'desc'),
            };
        } else {
            $requestQuery->orderBy('requested_at', 'desc');
        }

        $borrowRequests = $requestQuery->paginate(12)->withQueryString();

        return view('admin.dashboard', compact('catalogItems', 'borrowRequests'));
    }

    public function acceptRequest(BorrowRequest $borrowRequest): RedirectResponse
    {
        if ($borrowRequest->status === 'pending') {
            $borrowRequest->status = 'accepted';
            $borrowRequest->save();

            if ($borrowRequest->catalogItem && $borrowRequest->catalogItem->quantity > 0) {
                $borrowRequest->catalogItem->decrement('quantity');
            }
        }

        return back()->with('success', 'Permintaan peminjaman telah diterima.');
    }

    public function rejectRequest(BorrowRequest $borrowRequest): RedirectResponse
    {
        if ($borrowRequest->status === 'pending') {
            $borrowRequest->status = 'rejected';
            $borrowRequest->save();
        }

        return back()->with('success', 'Permintaan peminjaman telah ditolak.');
    }
}
