@include('templates/header')
<body>
    <div class="content-page">
        <div class="content-wrapper col-3-10">
            <h2>Register a new person</h2>
            <form id="add_person">
                <div class="box-input col-1">
                    <label class="box-input_label">Full name*</label>
                    <div class="box-input_border">
                        <input type="text" name="full_name" class="box-input_input campoObrigatorio">
                    </div>
                </div>
                <div class="box-input col-1">
                    <label class="box-input_label">Email*</label>
                    <div class="box-input_border">
                        <input type="text" name="email" class="box-input_input vEmail campoObrigatorio">
                    </div>
                </div>
                <div class="box-input box-input--phone resp-box col-1-2">
                    <label class="box-input_label">Phone number</label>
                    <div class="box-input_border">
                        <input type="text" name="phone_number" class="box-input_input phoneMask">
                    </div>
                </div>
                <div class="box-input box-input--whatsapp resp-box col-1-2">
                    <label class="box-input_label">Whatsapp</label>
                    <div class="box-input_border">
                        <input type="text" name="whatsapp" class="box-input_input phoneMask">
                    </div>
                </div>
                <div class="clear"></div>
                <button>Submit</button>
            </form>
            <form id="edit_person" class="hidden">
                <input type="hidden" name="id_person">
                <div class="box-input col-1">
                    <label class="box-input_label">Full name*</label>
                    <div class="box-input_border">
                        <input type="text" name="full_name" class="box-input_input campoObrigatorio">
                    </div>
                </div>
                <div class="box-input col-1">
                    <label class="box-input_label">Email*</label>
                    <div class="box-input_border">
                        <input type="text" name="email" class="box-input_input vEmail campoObrigatorio">
                    </div>
                </div>
                <div class="box-input box-input--phone resp-box col-1-2">
                    <label class="box-input_label">Phone number</label>
                    <div class="box-input_border">
                        <input type="text" name="phone_number" class="box-input_input phoneMask">
                    </div>
                </div>
                <div class="box-input box-input--whatsapp resp-box col-1-2">
                    <label class="box-input_label">Whatsapp</label>
                    <div class="box-input_border">
                        <input type="text" name="whatsapp" class="box-input_input phoneMask">
                    </div>
                </div>
                <div class="clear"></div>
                <button>Submit</button>
            </form>
        </div>
        <div class="content-wrapper col-7-10">
            <h1>Contact manager</h1>
            <table>
                <tr>
                    <th>Full name</th>
                    <th>Email</th>
                    <th>Phone number</th>
                    <th>Whatsapp</th>
                    <th>Action</th>
                </tr>
                @foreach($persons as $person)
                <tr>
                    <td>{{$person->full_name}}</td>
                    <td>{{$person->email}}</td>
                    <td>{{$person->phone_number}}</td>
                    <td>{{$person->whatsapp}}</td>
                    <td><a href="#" class="editButton" data-id="{{$person->id_person}}">Edit</a><a href="#" class="deleteButton" data-id="{{$person->id_person}}">Delete</a></td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</body>