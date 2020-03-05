import React, {Component} from 'react';
import ReactDom from 'react-dom';
import AccountInfo from "./AccountInfo";
import toastr from 'toastr';

/** class AccountForm */
class AccountForm extends Component {
    constructor(props) {
        super(props);

        this.state = {
            account: {
                email: '',
                name: ''
            },
            submit: {
                disabled: false,
                caption: 'Save',
                normal: 'Save',
                onSave: 'Saving...'
            }
        };
        this.fd = new FormData();
        this.userId = user_id;
        this.token = jQuery('meta[name="csrf-token"]').attr('content');

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

    componentDidMount() {
        console.log("Component Did Mount");
        this.loadAccount();
    }

    loadAccount = event => {
        axios.get('/user/' + this.userId + '/account', this.fd).then( res => {
            let newState = Object.assign({}, this.state.account, res.data);
            this.setState({ account: newState });
        }).catch( error => {
            console.log(error);
            this.setState({
                error: error
            });
        });
    };

    onAccountSettingChange = event => {
        let newState = Object.assign({}, this.state.account);
        newState[event.target.name] = event.target.value;
        this.setState({ account: newState });
    };

    onSubmit = event => {
        event.preventDefault();
        this.fd.append("name" , this.state.account.name);
        this.fd.append("email" , this.state.account.email);

        setTimeout(
            function() {
                this.setState({
                    submit: Object.assign({}, this.state.submit, { caption: this.state.submit.onSave, disabled: true })
                });
            }
                .bind(this),
            1200
        );
        this.fd.append('_method', 'PUT');
        axios.post('/user/' + this.userId + '/account', this.fd).then( res => {
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
                <AccountInfo
                    email={this.state.account.email}
                    name={this.state.account.name}
                    onChange={this.onAccountSettingChange}
                    onClick={this.onSubmit}
                    buttonCaption={this.state.submit.caption}
                    buttonState={this.state.submit.disabled}
                />
            </div>
        );
    }
}

export default AccountForm;

if (document.getElementById('account')) {
    ReactDom.render(<AccountForm />,
        document.getElementById('account')
    );
}