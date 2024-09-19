document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('providerModal');
    const form = document.getElementById('providerForm');
    const modalTitle = document.getElementById('modalTitle');
    const providerIdInput = document.getElementById('providerId');
    const providerNameInput = document.getElementById('providerName');
    const providerStatusInput = document.getElementById('providerStatus');
    const providerUrlInput = document.getElementById('providerUrl');
    const providerDurationVariableInput = document.getElementById('providerDurationVariable');
    const providerDifficultyVariableInput = document.getElementById('providerDifficultyVariable');
    const modalSubmitButton = document.getElementById('modalSubmit');
    let currentAction = 'add';

    document.getElementById('add-provider-btn').addEventListener('click', function () {
        currentAction = 'add';
        modalTitle.textContent = 'Add provider';
        providerIdInput.value = '';
        providerNameInput.value = '';
        providerStatusInput.value = '';
        providerUrlInput.value = '';
        providerDurationVariableInput.value = '';
        providerDifficultyVariableInput.value = '';
        showModal();
    });

    function openModal(action, id, name, status, url, durationVariable, difficultyVariable) {
        if (action === 'edit') {
            currentAction = 'edit';
            modalTitle.textContent = 'Edit provider';
            providerIdInput.value = id;
            providerNameInput.value = name;
            providerStatusInput.value = status;
            providerUrlInput.value = url;
            providerDurationVariableInput.value = durationVariable;
            providerDifficultyVariableInput.value = difficultyVariable;
        }
        showModal();
    }
    window.openModal = openModal;

    function showModal() {
        modal.style.display = 'block';
    }

    function closeModal() {
        modal.style.display = 'none';
    }

    document.querySelector('.close').addEventListener('click', closeModal);

    form.addEventListener('submit', function (e) {
        e.preventDefault();
        const name = providerNameInput.value;
        const status = providerStatusInput.value;
        const url = providerUrlInput.value;
        const durationVariable = providerDurationVariableInput.value;
        const difficultyVariable = providerDifficultyVariableInput.value;
        const id = providerIdInput.value;

        if (currentAction === 'add') {
            addProvider(name, status, url, durationVariable, difficultyVariable);
        } else if (currentAction === 'edit') {
            updateProvider(id, name, status, url, durationVariable, difficultyVariable);
        }
    });

    function addProvider(name, status, url, durationVariable, difficultyVariable) {
        fetch(window.routes.createProvider, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ name, status, url, durationVariable, difficultyVariable }),
        })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    const providerBody = document.getElementById('provider-body');
                    const row = document.createElement('tr');
                    row.setAttribute('data-id', data.data.id);
                    row.innerHTML = `
                        <td>${data.data.id}</td>
                        <td>${data.data.name}</td>
                        <td>${data.data.status}</td>
                        <td>${data.data.url}</td>
                        <td>${data.data.duration_variable}</td>
                        <td>${data.data.difficulty_variable}</td>
                        <td>
                            <button onclick="openModal('edit', ${data.data.id}, '${data.data.name}', '${data.data.status}', '${data.data.url}', '${data.data.duration_variable}', '${data.data.difficulty_variable}')" id="editButton">Edit</button>
                            <button class="delete" onclick="deleteProvider(${data.data.id})" id="deleteButton">Delete</button>
                        </td>
                    `;
                    providerBody.appendChild(row);
                    closeModal();
                    window.location.reload();
                } else {
                    showAlertModal('Failed to add provider');
                }
            })
            .catch(error => console.error('Error adding provider:', error));
    }

    function updateProvider(id, name, status, url, durationVariable, difficultyVariable) {
        fetch(window.routes.updateProvider, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ id, name, status, url, durationVariable, difficultyVariable }),
        })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    const row = document.querySelector(`tr[data-id='${id}']`);
                    row.children[1].textContent = data.data.name;
                    row.children[2].textContent = data.data.description || 'N/A';
                    closeModal();
                    window.location.reload()
                } else {
                    showAlertModal(data.message);
                }
            })
            .catch(error => console.error('Error updating provider:', error));
    }

    window.deleteProvider = function (id) {
        showConfirmModal('Are you sure you want to delete this provider?', function () {
            fetch(window.routes.deleteProvider.replace(':id', id), {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
            })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        const row = document.querySelector(`tr[data-id='${id}']`);
                        row.remove();
                    } else {
                        showAlertModal('Failed to delete provider');
                    }
                })
                .catch(error => console.error('Error deleting provider:', error));
        });
    };

    // Load all providers initially
    fetch(window.routes.getAllProviders, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
    })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                const providerBody = document.getElementById('provider-body');
                data.data.forEach(provider => {
                    const row = document.createElement('tr');
                    row.setAttribute('data-id', provider.id);
                    row.innerHTML = `
                        <td>${provider.id}</td>
                        <td>${provider.name}</td>
                        <td>${provider.status}</td>
                        <td>${provider.url}</td>
                        <td>${provider.duration_variable}</td>
                        <td>${provider.difficulty_variable}</td>
                        <td>
                            <button onclick="openModal('edit', ${provider.id}, '${provider.name}', '${provider.status}', '${provider.url}', '${provider.duration_variable}', '${provider.difficulty_variable}')" id="editButton">Edit</button>
                            <button class="delete" onclick="deleteProvider(${provider.id})" id="deleteButton">Delete</button>
                        </td>
                    `;
                    providerBody.appendChild(row);
                });
            } else {
                showAlertModal('Failed to load provider');
            }
        })
        .catch(error => console.error('Error loading providers:', error));

    document.getElementById('closeModal').addEventListener('click', closeAlertModal);

    function showAlertModal(message) {
        const modal = document.getElementById('alertModal');
        const modalBody = document.getElementById('alertModalBody');
        modalBody.textContent = message;
        modal.style.display = 'flex'; // Show the modal
    }

    function closeAlertModal() {
        const modal = document.getElementById('alertModal');
        modal.style.display = 'none'; // Hide the modal
    }


    function showConfirmModal(message, onConfirm) {
        const modal = document.getElementById('confirmModal');
        const modalBody = document.getElementById('confirmModalBody');
        modalBody.textContent = message;
        modal.style.display = 'flex'; // Show the modal

        const yesButton = document.getElementById('confirmYes');
        const noButton = document.getElementById('confirmNo');
        yesButton.onclick = function() {
            onConfirm();
            closeConfirmModal();
        };
        noButton.onclick = closeConfirmModal;
    }

    function closeConfirmModal() {
        const modal = document.getElementById('confirmModal');
        modal.style.display = 'none';
    }
});
