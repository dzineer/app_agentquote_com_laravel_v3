import React, { Component } from 'react';
import PropTypes from 'prop-types';
import TextInput from "../TextInput/TextInput";
import toastr from "toastr";

/** function: Modal */
class ContactMeModal extends Component {

    constructor(props) {
        super(props);

        this.state = {
            show_modal: true,
            contact: {
                name: '',
                phone: '',
                email: '',
                message: ''
            },
            submit: {
                disabled: false,
                caption: 'Save',
                done: 'Message Sent.',
                normal: 'Save',
                onSave: 'Sending...'
            }
        };

        this.token = jQuery('meta[name="csrf-token"]').attr('content')

        axios.defaults.headers.common = {
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': this.token
        };

        toastr.options = {
            "debug": false,
            "positionClass": "toast-bottom-right",
            "onclick": null,
            "fadeIn": 300,
            "fadeOut": 1000,
            "timeOut": 5000,
            "extendedTimeOut": 21000
        };
    }

    onFormFieldChange = event => {
        const newState = Object.assign({}, this.state.contact, { [event.target.name]: event.target.value });
        this.setState({
            contact: newState
        });
    };

    onSubmit = event => {
        event.preventDefault();
        console.log(this.state.contact);

        let fd = new FormData();

        fd.append("name" , this.state.contact.name);
        fd.append("phone" , this.state.contact.phone);
        fd.append("email" , this.state.contact.email);
        fd.append("message" , this.state.contact.message);

        setTimeout(
            function() {
                this.setState({
                    submit: Object.assign({}, this.state.submit, { caption: this.state.submit.onSave, disabled: true })
                });
            }
                .bind(this),
            1200
        );

        axios.post('/user/messages', fd).then( res => {
            console.log(res);

            setTimeout(
                function() {
                    this.setState({
                        submit: Object.assign({}, this.state.submit, { caption: this.state.submit.done, disabled: false })
                    });
                }
                    .bind(this),
                1200
            );

            if (res.data.success) {
                this.setState({contact: {}, show_modal: false});
                toastr.success('Message was sent.');

            } else {
                this.setState({contact: {}, show_modal: false});
            }
        }).catch( error => {
            setTimeout(
                function() {
                    this.setState({
                        submit: Object.assign({}, this.state.submit, { caption: this.state.submit.normal, disabled: false })
                    });
                }
                    .bind(this),
                1200
            );
            console.log(error);
            this.setState({contact: {}, show_modal: false});
        });

    };

    render() {

        const {label, from, email} = this.props;

        const fields = [
            {name: 'name', label: 'Name', type: 'single'},
            {name: 'phone', label: 'Phone', type: 'single'},
            {name: 'email', label: 'Email', type: 'single'},
            {name: 'message', label: 'Message', type: 'block', rows: 5}
        ];

        const styles = {
            for: {
                label: {
                    textAlign: 'left',
                    width: '100%'
                },
                modalTitle: {
                    width: '100%'
                }
            }
        };

        const form_fields = fields.map(field => {
            return field.type === 'single' ?
                <TextInput
                    key={field.name+field.label}
                    name={field.name}
                    id={field.name}
                    label={field.label}
                    required={false}
                    className="field-label"
                    styles={styles.for.label}
                    onChange={this.onFormFieldChange}
                />
                :
                <div className="form-group" key={field.name+field.label}>
                    <label htmlFor="message-text" className="col-form-label"
                           style={styles.for.label}>{field.label}</label>
                    <textarea className="form-control" id={field.name} name={field.name} rows={field.rows} onChange={this.onFormFieldChange} />
                </div>
        });

        const modal_header = (
            <div className="modal-header">
                <h5 className="modal-title" id="ModalLabel" style={styles.for.modalTitle}>Please be
                    sure to fill out the fields below:</h5>
                <button type="button" className="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        );

        const modal_body = (
            <div className="modal-body">
                <form>
                    {form_fields}
                </form>
            </div>
        );

        const modal_footer = (
            <div className="modal-footer">
                <button type="button" className="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" className="btn btn-primary" data-toggle="modal" data-target="#contactModal" data-whatever="@mdo" onClick={this.onSubmit}>Send message</button>
            </div>
        );

        const modal_window = (
            this.state.show_modal && <div>
                <a href="#" className="btn btn-primary btn-lg" data-toggle="modal" data-target="#contactModal" data-whatever="@mdo">{label}</a>

                <div className="modal fade" id="contactModal" tabIndex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                    <div className="modal-dialog modal-lg" role="document">
                        <div className="modal-content">
                            { modal_header }
                            { modal_body }
                            { modal_footer }
                        </div>
                    </div>
                </div>
            </div>

        );

        return (
            <div>
                { modal_window }
            </div>
        );
    }

}

ContactMeModal.propTypes = {

};

ContactMeModal.defaultProps = {
    //myProp: val
};

export default ContactMeModal;