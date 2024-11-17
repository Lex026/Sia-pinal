<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="resume-container">
        @foreach ($resumes as $resume)
        <div>
            <h1>{{$resume->name}}</h1>
            <p>{{$resume->email}}</p>
            <p>{{$resume->contact}}</p>
            <img src="./images/{{ $resume->image }}" alt="{{ $resume->name }}" height="50">
            <button class="view_resume" data-id="{{$resume->id}}">View Resume</button>
            <button class="edit_resume" data-id="{{$resume->id}}">Edit Resume</button>
            <button class="delete_resume" data-id="{{$resume->id}}">Delete Resume</button>
        </div>
        @endforeach
        <div>
            <button id="add_resume">Add New Resume</button>
        </div>
    </div>
    <div class="modal" style="position: fixed; top:50%;left:50%; transform:translate(-50%,-50%); background-color: white;
        border-radius: 0.25em; border: 2px solid black; padding:0.5em; display:none;
    ">
    </div>
    <script>
        document.querySelector('#add_resume').addEventListener('click', function() {
            window.location.href = '/add_resume';
        });
        document.querySelectorAll('.edit_resume').forEach(function(button) {
            button.addEventListener('click', function(e) {
                window.location.href = '/edit_resume/' + button.getAttribute('data-id');
            });
        });
        document.querySelectorAll('.view_resume').forEach(function(button) {
            button.addEventListener('click', function(e) {
                window.location.href = '/resume/' + button.getAttribute('data-id');
            });
        });
        document.querySelectorAll('.delete_resume').forEach(function(button) {
            button.addEventListener('click', function(e) {
                const modal = document.querySelector('.modal');
                modal.innerHTML = `
                    <div>
                        <h1>Are you sure you want to delete this resume?</h1>
                        <button id="yes" data-id="${button.getAttribute('data-id')}">Yes</button>
                        <button id="no">No</button>
                    </div>
                    `;
                modal.style.display = 'block';

                document.querySelector('#yes').addEventListener('click', async function(e) {

                    await fetch('/dashboard/' + button.getAttribute('data-id'), {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    }).then(response => {
                        if (response.ok) {
                            window.location.reload();
                        } else {
                            alert('Failed to delete resume.');
                        }
                    });
                });
                document.querySelector('#no').addEventListener('click', function(e) {
                    const modal = document.querySelector('.modal');
                    modal.innerHTML = '';
                    modal.style.display = 'none';
                });
            });

        });
    </script>
</body>

</html>