jQuery(document).ready(function()
{
    if($('.phoneMask').length)
    {
        $('.phoneMask').mask('(00) 0 0000-0000');
    }
    prepareFormData();
    getPersonData();
    deletePersonData();
})

function prepareFormData()
{
    $('#add_person, #edit_person').submit(function(e)
    {
        e.preventDefault();
        let _this = $(this);
        const url = mountUrl(_this);
        const _email	= $(".vEmail", _this).val();
        const emailFilter = /^.+@.+\..{2,}$/;
        const illegalChars = /[\(\)\<\>\,\;\:\\\/\"\[\]]/;

        if( !verifyRequiredFields(_this) )
        {
            alert('Preencha os campos obrigatórios');
            return false;
        }

        if(!(emailFilter.test(_email))||_email.match(illegalChars)){
            alert('O E-mail está em um formato incorreto!');
            return false;
        }

        let formData = $(this).serialize();
        sendData(formData, url);
    })
}

function getPersonData()
{
    $('.editButton').click(function(e)
    {
        e.preventDefault();

        $.ajax({
            type: 'POST',
            url: 'get-person',
            data: {'id_person': $(this).attr('data-id')},
            beforeSend: function(xhr){
                xhr.setRequestHeader('X-CSRF-TOKEN', $("#token").attr('content'));
            },
            success: function(response) {
                response = JSON.parse(response);
                if(!response.status)
                {
                    alert(response.message);
                    return false;
                }

                setEditFormData(response.person[0]);
                setEditFormVisible();
            },
            error: function(response)
            {
                alert('An error been occured');
            },
        });
    })
}

function deletePersonData()
{
    $('.deleteButton').click(function(e)
    {
        e.preventDefault();

        $.ajax({
            type: 'POST',
            url: 'delete-person',
            data: {'id_person': $(this).attr('data-id')},
            beforeSend: function(xhr){
                xhr.setRequestHeader('X-CSRF-TOKEN', $("#token").attr('content'));
            },
            success: function(response) {
                response = JSON.parse(response);
                if(!response.status)
                {
                    alert(response.message);
                    return false;
                }

                alert(response.message);
                document.location.reload();
            },
            error: function(response)
            {
                alert('An error been occured');
            },
        });
    })
}

function sendData(formData, url)
{
    $.ajax({
        type: 'POST',
        url: url,
        data: formData,
        beforeSend: function(xhr){
            xhr.setRequestHeader('X-CSRF-TOKEN', $("#token").attr('content'));
        },
        success: function(response) {
            response = JSON.parse(response);
            alert(response.message)
            document.location.reload();
        },
        error: function(response)
        {
            alert('An error been occured');
        },
    });
}

function verifyRequiredFields(form)
{
    let count = 0;
    let verification = false;
    $( ".campoObrigatorio", form ).each(function() {
        if($(this).val() == '')
        {
            count++;
        }
    });

    if(!count)
    {
        verification = true;
    }

    return verification;
}

function mountUrl(form)
{
    let url = '';
    form.attr('id') == 'add_person' ? url = 'insert-person' : url = 'edit-person';
    
    return url;
}

function setEditFormData(person)
{
    const form = $('#edit_person');

    $('input[name="id_person"]', form).val(person.id_person);
    $('input[name="full_name"]', form).val(person.full_name);
    $('input[name="email"]', form).val(person.email);
    $('input[name="phone_number"]', form).val(person.phone_number);
    $('input[name="whatsapp"]', form).val(person.whatsapp);
}

function setEditFormVisible()
{
    form = $('#edit_person');
    if(form.hasClass('hidden'))
    {
        $('form').addClass('hidden');
        form.removeClass('hidden');
    }
}