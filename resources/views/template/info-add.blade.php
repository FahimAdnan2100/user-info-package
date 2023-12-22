@extends('info::index')
@section('content')
    <div class="row justify-content-center mt-5">
        <div class="col-md-6 card m-5 p-4">
            <h4 class="text-center ">User Info List</h4>
            <hr>
            <table class="table table-bordered ">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Age</th>
                        <th scope="col">Address</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($infolists as $infolist)
                        <tr>
                            <td>{{ $infolist->name }}</td>
                            <td>{{ $infolist->age }}</td>
                            <td>{{ $infolist->address }}</td>
                            <td>
                                <button class="btn btn-success edit-info" type="button"
                                    value="{{ $infolist->id }}">Edit</button>
                                <button class="btn btn-danger delete-info" type="button"
                                    value="{{ $infolist->id }}">delete</button>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
            {{ $infolists->links('pagination::bootstrap-4') }}
        </div>
        <div class="col-md-4 card p-4">
            <h4 class="text-center">Add User Info</h4>
            <hr>
            <form method="post" action="{{ route('info.store') }}" class="needs-validation" id="info-form" novalidate>
                @csrf
                <input type="hidden" id="id" name="id">
                <div class="mb-3 form-group">
                    <label for="name" class="form-label">Name *</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                    <div class="invalid-feedback">
                        <span>Name is required</span>
                    </div>
                </div>
                <div class="mb-3 form-group">
                    <label for="age" class="form-label">Age *</label>
                    <input type="number" class="form-control" id="age" name="age" required>
                    <div class="invalid-feedback">
                        <span>Age is required</span>
                    </div>
                </div>
                <div class="mb-3 form-group">
                    <label for="address" class="form-label">Address *</label>
                    <input type="text" class="form-control" id="address" name="address" required>
                    <div class="invalid-feedback">
                        <span>Address is required</span>
                    </div>
                </div>
                <button type="submit" id="save-btn" class="btn btn-primary">Save</button>
                <button type="submit" id="update-btn" class="btn btn-primary d-none">Update</button>
            </form>
        </div>
    </div>

    <script>
        //get info
        document.addEventListener('DOMContentLoaded', function() {
            document.addEventListener('click', function(e) {
                if (e.target.classList.contains('edit-info')) {
                    e.preventDefault();
                    let infoId = e.target.value;
                    fetch(`/get-user-info/${infoId}`)
                        .then(response => response.json())
                        .then(data => {
                            document.getElementById('id').value = data.id;
                            document.getElementById('name').value = data.name;
                            document.getElementById('age').value = data.age;
                            document.getElementById('address').value = data.address;
                            let saveButton = document.getElementById('save-btn');
                            saveButton.classList.add('d-none');
                            let updateButton = document.getElementById('update-btn');
                            updateButton.classList.remove('d-none');
                        })
                        .catch(error => console.error('Error:', error));
                }
            });
        });

        //update
        document.addEventListener('DOMContentLoaded', function() {
            const updateButton = document.getElementById('update-btn');

            if (updateButton) {
                updateButton.addEventListener('click', function(e) {
                    e.preventDefault();

                    let formData = new FormData(document.getElementById('info-form'));

                    fetch('/update-user-info', {
                            method: 'POST',
                            body: formData
                        })
                        .then(response => response.json())
                        .then(data => {
                            toastr.options = {
                                "progressBar": true,
                                "closeButton": true
                            };
                            toastr.success("{{ Session::get('success') }}", "Updated!", {
                                timeOut: 3000
                            });
                            location.reload();
                        })
                        .catch(error => {
                            toastr.error('Validation Error');
                            console.error('Error:', error);
                        });
                });
            }
        });



        //delete
        document.addEventListener('DOMContentLoaded', function() {
            document.addEventListener('click', function(e) {
                if (e.target.classList.contains('delete-info')) {
                    e.preventDefault();
                    let infoId = e.target.value;
                    fetch(`/delete-user-info/${infoId}`)
                        .then(response => response.json())
                        .then(data => {
                            toastr.options = {
                                "progressBar": true,
                                "closeButton": true
                            };
                            toastr.success("{{ Session::get('success') }}", "Deleted!", {
                                timeOut: 3000
                            });
                            location.reload();
                        })
                        .catch(error => toastr.error('Validation Error'));
                }
            });
        });
    </script>
@endsection
