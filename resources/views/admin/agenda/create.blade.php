<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">{{ __('Add New Agenda') }}</h2>
    </x-slot>
    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.agenda.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" name="title" class="form-control" required>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="date" class="form-label">Date</label>
                        <input type="date" name="date" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="time" class="form-label">Time</label>
                        <input type="time" name="time" class="form-control" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description (Optional)</label>
                    <textarea name="description" class="form-control" rows="3"></textarea>
                </div>
                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.agenda.index') }}" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary">Save Agenda</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
