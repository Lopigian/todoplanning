@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="header-information">
            <h1>Provider Management</h1>
            <button id="add-provider-btn">Add Provider</button>
        </div>
        <table id="provider-table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Status</th>
                <th>Url</th>
                <th>Duration Variable</th>
                <th>Difficulty Variable</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody id="provider-body">

            </tbody>
        </table>
    </div>

    <!-- Modal HTML -->
    <div id="providerModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2 id="modalTitle">Add provider</h2>
            <form id="providerForm">
                <input type="hidden" id="providerId" name="id">
                <label for="providerName">Name:</label>
                <input type="text" id="providerName" name="name" required>
                <label for="providerStatus">Status:</label>
                <select name="status" id="providerStatus">
                    @foreach(\App\Helpers\StatusEnum::cases() as $key => $status)
                        <option value="{{ $status }}">{{$key}}</option>
                    @endforeach
                </select>
                <label for="providerUrl">Url:</label>
                <input type="text" id="providerUrl" name="url" required>
                <label for="providerDurationVariable">Duration Variable:</label>
                <input type="text" id="providerDurationVariable" name="duration_variable" required>
                <label for="providerDifficultyVariable">Difficulty Variable:</label>
                <input type="text" id="providerDifficultyVariable" name="difficulty_variable" required>
                <button type="submit" id="modalSubmit">Save</button>
            </form>
        </div>
    </div>


    <!-- Simple Alert Modal -->
    <div id="alertModal">
        <div class="alertModal">
            <h2>Alert</h2>
            <p id="alertModalBody"></p>
            <button id="closeModal">Close</button>
        </div>
    </div>


    <!-- Confirm Modal -->
    <div id="confirmModal">
        <div class="confirmModal">
            <h2>Confirmation</h2>
            <p id="confirmModalBody"></p>
            <button id="confirmYes">Yes</button>
            <button id="confirmNo">No</button>
        </div>
    </div>
@endsection
