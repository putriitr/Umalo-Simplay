@extends('layouts.Admin.master')
@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">

                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="card-title">
                        <h1>Negotiations</h1>
                    </div>
                </div>

                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <div class="card-body">
                    <div class="row">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>ID</th>
                                        <th>Quotation Number</th>
                                        <th>Negotiated Price</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($negotiations as $negotiation)
                                        <tr>
                                            <td>{{ $negotiation->id }}</td>
                                            <td>{{ $negotiation->quotation->quotation_number }}</td>
                                            <td>{{ number_format($negotiation->negotiated_price, 2) }}</td>
                                            <td>{{ ucfirst($negotiation->status) }}</td>
                                            <td>
                                                <!-- Tombol untuk memicu modal Accept -->
                                                <button class="btn btn-success btn-sm"
                                                    onclick="openModal({{ $negotiation->id }}, 'accept')">Accept</button>
                                                <!-- Tombol untuk memicu modal Reject -->
                                                <button class="btn btn-danger btn-sm"
                                                    onclick="openModal({{ $negotiation->id }}, 'reject')">Reject</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- Modal untuk Accept/Reject Notes -->
                        <div class="modal fade" id="notesModal" tabindex="-1" aria-labelledby="notesModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form id="notesForm" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="notesModalLabel">Add Notes</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="notes">Notes</label>
                                                <textarea class="form-control" id="notes" name="notes" rows="4"
                                                    required></textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>  

<script>
    function openModal(id, action) {
        // Set form action based on Accept or Reject
        let url = action === 'accept'
            ? "{{ url('/admin/quotations/negotiations') }}/" + id + "/accept"
            : "{{ url('/admin/quotations/negotiations') }}/" + id + "/reject";

        document.getElementById('notesForm').action = url;
        // Open modal
        var notesModal = new bootstrap.Modal(document.getElementById('notesModal'));
        notesModal.show();
    }
</script>
@endsection