function showModalProfileDeletion(){
        $('#modalProfileDeletion').modal('show');
}

$('#modalProfileDeletion').on('hidden.bs.modal', function() {
    $('#profiledeletionForm').formValidation('resetForm', true);
    $('#profiledeletion-errors').html('');
});


$(document).ready(function() {
    $('#profiledeletionForm').on('init.field.fv', function(e, data) {
            var field  = data.field,        // Get the field name
                $field = data.element,      // Get the field element
                bv     = data.fv;           // FormValidation instance

            // Create a span element to show valid message
            // and place it right before the field
            var $span = $('<small/>')
                            .addClass('help-block validMessage')
                            .attr('data-field', field)
                            .insertAfter($field)
                            .hide();

            // Retrieve the valid message via getOptions()
            var message = bv.getOptions(field).validMessage;

            if (message) {
                $span.html(message);
            }
        })
	.formValidation({
        //container: '#messages',
	framework: 'bootstrap',
        message: "Cette valeur n'est pas valide",
	verbose: 'false',
	excluded: 'disabled',
	trigger: 'blur',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            final_deletion_string: {
                validators: {
                    stringLength: {
			min: 9,
			max: 9,
                        message: "La chaine de caractères entrée ne supprimera pas votre compte"
                    },
		    regexp: {
                            regexp: /^SUPPRIMER$/,
                            message: "La chaine de caractères entrée ne supprimera pas votre compte"
                    },
		    stringCase: {
                        message: "La chaine de caractères entrée ne supprimera pas votre compte",
                        'case': 'upper'
                    }
                }
            }
        }
    })
    .on('success.form.fv', function(e) {
            // Reset the message element when the form is valid
            $('#profiledeletion-errors').html('');
        })
    .on('err.field.fv', function(e, data) {
            // data.fv      --> The FormValidation instance
            // data.field   --> The field name
            // data.element --> The field element

            // Get the messages of field
            var messages = data.fv.getMessages(data.element);

            // Remove the field messages if they're already available
            $('').find('li[data-field="' + data.field + '"]').remove();

            // Loop over the messages
            for (var i in messages) {
                // Create new 'li' element to show the message
                $('<li/>')
                    .attr('data-field', data.field)
                    .wrapInner(
                        $('<a/>')
                            .attr('href', 'javascript: void(0);')
                            .html(messages[i])
                            .on('click', function(e) {
                                // Hide the modal first
                                $('#modalProfileDeletion').modal('hide');

                                // Focus on the invalid field
                                data.element.focus();
                            })
                    )
                    .appendTo('#profiledeletion-errors');
            }

            // Hide the default message
            // data.element.data('fv.messages') returns the field messages element
            data.element
                .data('fv.messages')
                .find('.help-block[data-fv-for="' + data.field + '"]')
                .hide();
        })
     .on('success.field.fv', function(e, data) {
            // Remove the field messages
            $('#profiledeletion-errors').foinli[data-field="' + data.field + '"]').remove();
        })
        .on('err.form.fv', function(e) {
            // Show the message modal
            $('#modalProfileDeletion').modal('show');
        })
    .on('success.form.fv', function(e) {
            // Prevent form submission
            e.preventDefault();

            // Some instances you can use are
            var $form = $(e.target),        // The form instance
                fv    = $(e.target).data('formValidation'); // FormValidation instance

	    // By default, this action will redirect to PHP Action of the form //
            fv.defaultSubmit()

	    //$('#modalProfileDeletion').on('#forgotpasslink', function(e) {
	      //$('#modalProfileDeletion').modal('close');
	      //$('#ModalForgottenPass').modal('show');
	    //});
        });
    // Enable the password/password_check validators if the password is not empty

    // Enable the email/email_check validators if the email is not empty
});

