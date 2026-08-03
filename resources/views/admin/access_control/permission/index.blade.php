@extends('layouts.app')

@section('title', 'Permissions')

@push('css')
<style>
    .perm-toolbar {
        display: flex;
        align-items: center;
        gap: 8px;
        flex-wrap: wrap;
        margin-bottom: 14px;
    }
    .perm-toolbar input[type="search"] {
        max-width: 320px;
        flex: 1 1 220px;
    }
    .perm-card {
        margin-bottom: 12px;
        border-radius: 6px;
        overflow: hidden;
        box-shadow: 0 1px 2px rgba(0, 0, 0, .04);
    }
    .perm-card__header {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px 14px;
        background: #fff;
        border: 1px solid #e5e7eb;
        cursor: pointer;
        user-select: none;
        transition: background .15s ease;
    }
    .perm-card__header:hover { background: #f9fafb; }
    .perm-card__title {
        font-weight: 600;
        color: #374151;
        flex: 1;
        font-size: 14px;
    }
    .perm-card__count {
        background: var(--popi-pink-soft, rgba(232, 23, 93, .15));
        color: var(--popi-pink, #E8175D);
        font-size: 12px;
        font-weight: 600;
        padding: 3px 10px;
        border-radius: 12px;
        min-width: 32px;
        text-align: center;
    }
    .perm-card__chevron {
        color: #9ca3af;
        font-size: 12px;
        transition: transform .2s ease;
    }
    .perm-card.is-collapsed .perm-card__chevron { transform: rotate(-90deg); }
    .perm-card__body {
        border: 1px solid #e5e7eb;
        border-top: none;
        background: #fff;
    }
    .perm-card.is-collapsed .perm-card__body { display: none; }
    .perm-card__body table { margin: 0; }
    .perm-card__body thead th {
        background: #f8f9fa;
        font-size: 11px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: .5px;
        color: #6b7280;
        border-bottom: 1px solid #e5e7eb;
    }
    .perm-card__body tbody td {
        font-size: 13px;
        vertical-align: middle;
        border-top: 1px solid #f3f4f6;
    }
    .perm-card__body tbody tr:last-child td { border-bottom: none; }
    .perm-card__body code {
        color: #6b7280;
        background: #f3f4f6;
        padding: 1px 6px;
        border-radius: 3px;
        font-size: 12px;
    }
    .perm-empty {
        padding: 40px 20px;
        text-align: center;
        color: #9ca3af;
        background: #fff;
        border: 1px dashed #e5e7eb;
        border-radius: 6px;
    }
    .perm-empty i { color: #d1d5db; }
    .perm-section-label {
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: #9ca3af;
        margin: 18px 0 8px 4px;
    }
    .perm-section-label:first-child { margin-top: 0; }
</style>
@endpush

@section('content')
<div class="container-fluid">

    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">
                    <i class="fa fa-key text-muted"></i> Permission Lists
                    <small class="text-muted ml-2">
                        ({{ $total }} total · {{ $parents->count() }} groups)
                    </small>
                </h4>
                <div class="page-title-right">
                    <a href="{{ route('permission.create') }}" class="btn btn-info">
                        <i class="fa fa-plus"></i> Add Permission
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="perm-toolbar">
        <input type="search" id="permission-search" class="form-control"
               placeholder="Search by permission name…" autocomplete="off">
        <button type="button" id="perm-expand-all" class="btn btn-sm btn-outline-secondary">
            <i class="fa fa-arrows-alt"></i> Expand all
        </button>
        <button type="button" id="perm-collapse-all" class="btn btn-sm btn-outline-secondary">
            <i class="fa fa-compress"></i> Collapse all
        </button>
        <span id="perm-match-count" class="text-muted small ml-auto"></span>
    </div>

    <div id="perm-no-matches" class="perm-empty" style="display:none;">
        <i class="fa fa-search fa-2x"></i>
        <p class="mt-2 mb-0">No permissions match your search.</p>
    </div>

    <div id="perm-groups">
        @foreach($parents as $parent)
            @php $rows = $grouped[$parent]; @endphp
            <div class="perm-card" data-perm-card data-parent="{{ $parent }}">
                <div class="perm-card__header" data-perm-toggle>
                    <i class="fa fa-chevron-down perm-card__chevron"></i>
                    <i class="fa fa-folder-open text-warning"></i>
                    <span class="perm-card__title">{{ $parent }}</span>
                    <span class="perm-card__count" data-perm-count>{{ $rows->count() }}</span>
                </div>
                <div class="perm-card__body">
                    <table class="table table-sm table-striped mb-0">
                        <thead>
                            <tr>
                                <th style="width:90px;">ID</th>
                                <th>Name</th>
                                <th style="width:140px;">Guard</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($rows as $row)
                                <tr data-perm-row
                                    data-perm-name="{{ strtolower($row->name) }}">
                                    <td><code>#{{ $row->id }}</code></td>
                                    <td><strong>{{ $row->name }}</strong></td>
                                    <td>
                                        <span class="badge badge-secondary">
                                            {{ $row->guard_name ?: '—' }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection

@push('script')
<script>
(function () {
    var search    = document.getElementById('permission-search');
    var cards     = document.querySelectorAll('[data-perm-card]');
    var noMatches = document.getElementById('perm-no-matches');
    var matchLbl  = document.getElementById('perm-match-count');
    var total     = {{ (int) $total }};

    function applyFilter() {
        var q           = (search.value || '').trim().toLowerCase();
        var visibleRows = 0;

        cards.forEach(function (card) {
            var rows           = card.querySelectorAll('[data-perm-row]');
            var visibleInGroup = 0;

            rows.forEach(function (row) {
                var name = row.getAttribute('data-perm-name') || '';
                var show = !q || name.indexOf(q) !== -1;
                row.style.display = show ? '' : 'none';
                if (show) visibleInGroup++;
            });

            var hasMatch = visibleInGroup > 0;
            card.style.display = hasMatch ? '' : 'none';
            visibleRows += visibleInGroup;

            var countEl = card.querySelector('[data-perm-count]');
            if (countEl) {
                countEl.textContent = q
                    ? visibleInGroup + ' / ' + rows.length
                    : rows.length;
            }

            if (q && hasMatch) {
                card.classList.remove('is-collapsed');
                var body = card.querySelector('.perm-card__body');
                if (body) body.style.display = '';
            }
        });

        if (q) {
            noMatches.style.display = visibleRows === 0 ? '' : 'none';
            matchLbl.textContent    = visibleRows + ' of ' + total + ' match';
        } else {
            noMatches.style.display = 'none';
            matchLbl.textContent    = '';
        }
    }

    function toggleAll(collapse) {
        cards.forEach(function (card) {
            var body = card.querySelector('.perm-card__body');
            if (collapse) {
                card.classList.add('is-collapsed');
                if (body) body.style.display = 'none';
            } else {
                card.classList.remove('is-collapsed');
                if (body) body.style.display = '';
            }
        });
    }

    if (search) search.addEventListener('input', applyFilter);

    var expandBtn   = document.getElementById('perm-expand-all');
    var collapseBtn = document.getElementById('perm-collapse-all');
    if (expandBtn)   expandBtn.addEventListener('click',   function () { toggleAll(false); });
    if (collapseBtn) collapseBtn.addEventListener('click', function () { toggleAll(true);  });

    cards.forEach(function (card) {
        var toggle = card.querySelector('[data-perm-toggle]');
        if (toggle) {
            toggle.addEventListener('click', function () {
                card.classList.toggle('is-collapsed');
                var body = card.querySelector('.perm-card__body');
                if (body) {
                    body.style.display = card.classList.contains('is-collapsed') ? 'none' : '';
                }
            });
        }
    });
})();
</script>
@endpush
