import React, { Component } from 'react';
import { render } from 'react-dom';
import PropTypes from 'prop-types';
import toastr from 'toastr';
import DataPagination from "../Tables/DataPagination";

/** class WHMCSClientsTable */
class WHMCSClientsTable extends Component {

    constructor(props) {
        super(props);

        this.state = {
            fields: {
                id: '',
                firstname: '',
                lastname: '',
                companyname: '',
                email: '',
                datecreated: '',
                groupid: '',
                status: '',
            },
            clients: [],
            pagination: null,
            checkboxes: [],
            show_panel: false,
            selected_user: null
        };

        this.validators = {
            'name': (field) => {
                let fieldName = 'Affiliate name';
                let success = field.length > 2;
                return {
                    success: success,
                    message: fieldName + ' must be 2 or more characters'
                };
            },
            'firstname': (field) => {
                let fieldName = 'First name';
                let success = field.length > 2;
                return {
                    success: success,
                    message: fieldName + ' must be 2 or more characters'
                };
            },
            'lastname': (field) => {
                let fieldName = 'Last name';
                let success = field.length > 2;
                return {
                    success: success,
                    message: fieldName + ' must be 2 or more characters'
                };
            },
            'companyname': (field) => {
                let fieldName = 'Company name';
                let success = field.length > 2;
                return {
                    success: success,
                    message: fieldName + ' must be 2 or more characters'
                };
            },
            'email': (field) => {
                let fieldName = 'Email';
                let success = field.length > 2;
                return {
                    success: success,
                    message: fieldName + ' must be 2 or more characters'
                };
            },
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

       this.onCheckAllChange.bind(this);
       this.onCheckboxChange.bind(this);
       this.getActions.bind(this);
       this.onCheckboxChange.bind(this);
       this.onShowPanel.bind(this);
       this.onCancel.bind(this);
       this.onSave.bind(this);
    }

    message = (type, msg) => {
        switch(type) {
            case 'success':
                toastr.success(msg);
                break;
            case 'warn':
                toastr.warn(msg);
                break;
            case 'info':
                toastr.info(msg);
                break;
            case 'error':
                toastr.error(msg);
                break;

            default:
                toastr.info(msg);
        }
    };

    onChange = (e) => {
        let fields = Object.assign({}, this.state.fields);
        fields[e.target.name] = e.target.value;
        this.setState({
            fields
        });
    };

    showErrors = (errors) => {
        let messages = '';

        for(let prop in errors) {
            if (errors.hasOwnProperty(prop)) {
                messages += "\n" + this.fieldErrors[prop];
            }
        }

        message.error(messages);
    };

    componentWillMount() {
       // this.setCheckboxes(false);
        debugger;
        console.log('WHMCSClientsTable::componentWillMount - clients', this.props.clients);
        this.setState({
            clients: this.props.clients,
            pagination: this.props.pagination
        });
    }

    onCheckboxChange = (user, checked) => {
        let checkboxes = Object.assign([], this.state.checkboxes);
        // uncheck all in memory
        for(let i=0; i < this.state.clients.length; i++) {
            checkboxes[this.state.clients[i].user_id] = false;
        }

        if (checked) {
            checkboxes[user.user_id] = true;
            this.setState({
                checkboxes: checkboxes,
                selected_user: user
            });
        } else {

            this.setState({
                checkboxes: checkboxes,
                selected_user: null
            });

        }
    };

    onCheckAllChange = (e) => {
        let checkboxes = Object.assign([], this.state.checkboxes);
        checkboxes = checkboxes.map( checkbox => {
            return ! checkbox
        });
        this.setState({ checkboxes });
    };

    validateField = (field, validator) => {
        return validator(field);
    };

    onCancel = (e) => {
        e.preventDefault();
        this.setState({ show_panel: false });
    };

    onSave = () => {
        this.setState({ show_panel: false });
    };

    onShowPanel = (e) => {
        e.preventDefault();
        this.setState({ show_panel: true });
    };

    getActions = () => {

        let actions = [
            { 'name' : 'enable user', 'callback': this.enableUser },
            { 'name' : 'disable user', 'callback': this.disableUser },
            { 'name' : 'reset password', 'callback': this.passwordReset },
            { 'name' : 'send coupon code', 'callback': this.sendCouponCode },
        ];

        return (
            ! this.state.show_panel && <div>
                <div className="dropdown mr-4">
                    <button type="button" className="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                        Actions
                    </button>
                    <div className="dropdown-menu">
                        {actions.map(action => {
                            return <a className="dropdown-item" href="#" key={action}
                                      onClick={action.callback}>{action.name.charAt(0).toUpperCase() + action.name.slice(1)}</a>;
                        })}
                    </div>
                </div>
{/*
                <a href="#" className="btn btn-secondary my-20" onClick={this.onShowPanel}>+Add Affiliate</a>
*/}
            </div>
        );
    };

    render() {

        let styles = {
            checkbox: {
                textAlign: 'center'
            },
            formContainer: {
                "padding": "20px",
                "border": "1px solid #cccccc6b",
                "margin": "14px 0px 0px",
                "borderRadius": "5px"
            }
        };

        return (

            <div className="row">

                <div className="col-md-12">
                    <p className="">Please note: You can only select only one user per action above. To perform an action, select one user and choose from the actions menu above.</p>
                    { this.getActions() }
                </div>

                <div className="col-md-12">

                    <div className="_fd3-table-responsive">
                        <table className="table table-striped table-bordered tablesorter affiliates-list">
                            <thead>
                            <tr>
                                <th style={styles.checkbox} >

                                </th>
                                <th className="sheader">Id
                                    <a href={ '?sortby=fname&order=asc' + '&page='  }
                                       className="ascending" title="Ascending" />

                                    <a href={ '?sortby=fname&order=desc' + '&page='  }
                                       className="descending" title="Descending" />
                                </th>
                                   <th className="sheader">Name
                                    <a href={ '?sortby=email&order=asc' + '&page='  }
                                       className="ascending" title="Ascending" />

                                    <a href={  '?sortby=email&order=desc' + '&page='  }
                                       className="descending" title="Descending" />
                                </th>

                                <th className="sheader">Company
                                    <a href={ '?sortby=last_login&order=asc' + '&page=' }
                                       className="ascending" title="Ascending" />

                                    <a href={ '?sortby=last_login&order=desc' + '&page=' }
                                       className="descending" title="Descending" />
                                </th>

                                <th className="sheader">Email
                                    <a href={ '?sortby=last_login&order=asc' + '&page=' }
                                       className="ascending" title="Ascending" />

                                    <a href={ '?sortby=last_login&order=desc' + '&page=' }
                                       className="descending" title="Descending" />
                                </th>

                                <th className="sheader">Date
                                    <a href={ '?sortby=last_login&order=asc' + '&page=' }
                                       className="ascending" title="Ascending" />

                                    <a href={ '?sortby=last_login&order=desc' + '&page=' }
                                       className="descending" title="Descending" />
                                </th>

                                <th className="sheader">Status
                                </th>
                            </tr>
                            </thead>
                            <tbody>

                            { this.state.clients.map( client => {
                               return <tr key={ client.id }>
                                    <td><input type="checkbox" /></td>
                                    <td>{ client.id }</td>
                                    <td>{ client.firstname + " " + client.lastname }</td>
                                    <td>{ client.companyname }</td>
                                    <td>{ client.email }</td>
                                    <td>{ client.datecreated }</td>
                                    <td>{ client.status }</td>
                                </tr>
                            })}

                            </tbody>
                        </table>
                    </div>

                    { this.state.pagination &&
                       <DataPagination
                           pagination={ this.state.pagination }
                           key={ this.state.pagination.current_page }
                           onFirst={ this.props.onFirst }
                           onNext={ this.props.onNext }
                           onPrevious={ this.props.onPrevious }
                           onLast={ this.props.onLast }
                           onPage={ this.props.onPage }
                       /> }

                </div>

            </div>
        );
    }
}

WHMCSClientsTable.propTypes = {
    clients: PropTypes.array.isRequired,
    pagination: PropTypes.object.isRequired,
    onFirst: PropTypes.func.isRequired,
    onPrevious: PropTypes.func.isRequired,
    onNext: PropTypes.func.isRequired,
    onLast: PropTypes.func.isRequired,
    onPage: PropTypes.func.isRequired,
};

WHMCSClientsTable.defaultProps = {
    clients: [],
    pagination: {},
    onFirst: () => {},
    onPrevious: () => {},
    onNext: () => {},
    onLast: () => {},
    onPage: () => {}
};

export default WHMCSClientsTable;

