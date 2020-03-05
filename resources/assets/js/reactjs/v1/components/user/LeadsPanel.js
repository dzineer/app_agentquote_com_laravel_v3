import React, { Component } from 'react';
import TextInput from '../TextInput';
import ReactDom, { render } from "react-dom";
import toastr from "toastr";
import Leads from "./Leads";
import LeadsControl from "./LeadsControl";

/** function: LeadsPanel */
class LeadsPanel extends Component {
    constructor(props) {
        super(props);

        this.state = {
            current_password: '',
            new_password: '',
            confirm_new_password: '',
            submit: {
                disabled: false,
                caption: 'Change password',
                normal: 'Change password',
                onSave: 'Updating password...'
            }
        };

        this.userId = user_id;
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

    updateHandler = event => {
        console.log(event.target.value);
        const newState = Object.assign({}, this.state, { [event.target.name]: event.target.value });
        this.setState(newState);
    };

    onSave = event => {

        event.preventDefault();
        let fd = new FormData();

        if (!this.state.current_password.length) {
            toastr.error("Please provide your existing password.");
            return;
        }

        if (!this.state.new_password.length) {
            toastr.error("You must provide a new password.");
            return;
        }

        if (this.state.new_password !== this.state.confirm_new_password) {
            toastr.error("Your New password and Confirmed Password do not match.");
            return;
        }

        fd.append('current_password', this.state.current_password);
        fd.append('new_password', this.state.new_password);
        fd.append('_method', 'PUT');

        setTimeout(
            function() {
                this.setState({
                    submit: Object.assign({}, this.state.submit, { caption: this.state.submit.onSave, disabled: true })
                });
            }.bind(this), 1200 );

        axios.post('/account/' + this.userId + '/security', fd).then( res => {
            if (res.data.success) {
                setTimeout(
                    function() {
                        this.setState({
                            submit: Object.assign({}, this.state.submit, { caption: this.state.submit.normal, disabled: false })
                        });
                    }
                        .bind(this),
                    1200
                );
                toastr.success(res.data.message);
            } else if (res.data.failed) {
                setTimeout(
                    function() {
                        this.setState({
                            submit: Object.assign({}, this.state.submit, { caption: this.state.submit.normal, disabled: false })
                        });
                    }
                        .bind(this),
                    1200
                );
                toastr.error(res.data.message);
            } else {
                setTimeout(
                    function() {
                        this.setState({
                            submit: Object.assign({}, this.state.submit, { caption: this.state.submit.normal, disabled: false })
                        });
                    }
                        .bind(this),
                    1200
                );
                toastr.error(res.data.message);
            }
            console.log(res.data);
        }).catch( error => {
            this.setState({
                submit: Object.assign({}, this.state.submit, { caption: this.state.submit.normal, disabled: false })
            });
            toastr.error("An error occurred, please try again later.");
            console.log(error);
        });
    };

    render() {
        return (
            <div>
                <LeadsControl />
                <Leads />
            </div>
        );
    }
}

export default LeadsPanel;

if (document.getElementById('leads')) {
    render(<LeadsPanel />,
        document.getElementById('leads')
    );
}