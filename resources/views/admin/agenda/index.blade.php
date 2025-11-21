<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2 class="h4 font-weight-bold mb-0">{{ __('Agenda Management') }}</h2>
                <p class="text-muted small mb-0">Manage all scheduled events and activities.</p>
            </div>
            <a href="{{ route('admin.agenda.create') }}" class="btn btn-primary d-flex align-items-center">
                <i class="fas fa-plus me-2"></i> {{ __('Add New Agenda') }}
            </a>
        </div>
    </x-slot>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th style="width: 40%;">Title</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($agendas as $agenda)
                            <tr>
                                <td>
                                    <div class="fw-bold">{{ $agenda->title }}</div>
                                    @if($agenda->description)
                                        <small class="text-muted">{{ Str::limit($agenda->description, 70) }}</small>
                                    @endif
                                </td>
                                <td>{{ $agenda->date->format('d F Y') }}</td>
                                <td>{{ $agenda->time->format('H:i') }} WIB</td>
                                <td class="text-end">
                                    <a href="{{ route('admin.agenda.edit', $agenda) }}" class="btn btn-sm btn-outline-primary" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.agenda.destroy', $agenda) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this agenda?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center p-5">
                                    <h5 class="mb-2 text-muted">No Agenda Found</h5>
                                    <p class="text-muted">Get started by creating your first agenda.</p>
                                    <a href="{{ route('admin.agenda.create') }}" class="btn btn-primary btn-sm mt-2">
                                        <i class="fas fa-plus me-2"></i> Add New Agenda
                                    </a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            {{-- Tampilkan pagination jika ada --}}
            @if ($agendas->hasPages())
                <div class="mt-3">
                    {{ $agendas->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>

