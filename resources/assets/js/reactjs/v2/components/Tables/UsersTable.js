import React, { Component } from 'react';
import { render } from 'react-dom';
import PropTypes from 'prop-types';
import toastr from 'toastr';
import UserLine from "./UserLine";
import Request from '../../utils/FD3Request';
import Pagination from "./Pagination";

/** class UsersTable */
class UsersTable extends Component {

    constructor(props) {
        super(props);

        this.state = {
            affiliate_id: this.props.affiliate_id,
            agents: this.props.agents,
            checkboxes: [],
            selected_user: null
        };

        this.fieldErrors = {
            carrier_id: "Please choose a preferred carrier.",
            body: "Please provide Ad Text."
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

        this.AFFILIATE_USER = 2;
        this.PROGRAM_USER = 5;

       this.onGroupChange.bind(this);
       this.onCheckAllChange.bind(this);
       this.onCheckboxChange.bind(this);
       this.getActions.bind(this);
       this.enableUser.bind(this);
       this.disableUser.bind(this);
       this.onCheckboxChange.bind(this);
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

    updateGroups = (new_group, data) => {
        let newState = Object.assign({}, this.state);
        newState.groups.push(data.group);
        this.setState(newState);
        this.message("success", data.message);
    };

    showErrors = (errors) => {
        let messages = '';

        for(let prop in errors) {
            if (errors.hasOwnProperty(prop)) {
                messages += "\n" + this.fieldErrors[prop];
            }
        }

        this.message("error", messages);
    };

    sanitizeGroupName = (g) => {
        g = g.trim();
        g = g.replace(/[^A-Za-z0-9\s]/g,'');
        g = g.replace(/_/gi, "");
        g = g.replace(/ +(?= )/g,'');
        g = g.trim();
        return g;
    };

    componentWillMount() {
        this.setCheckboxes(false);
    }

    setCheckboxes = (checked) => {
        let checkboxes = [];

        for(let i=0; i < this.state.agents.length; i++) {
            checkboxes[this.state.agents[i].user_id] = checked;
        }

        this.setState({
            checkboxes
        });
    };

    onGroupChange = (new_group, user, cb) => {

        let safe_description = this.sanitizeGroupName(new_group);
        let name = safe_description.replace(/\s/gi, "_").toLowerCase();

        let data = Request.toDataForm({
            "affiliate_id": this.state.affiliate_id,
            "name": name,
            "description": safe_description,
            "user_id": user.user_id
        });

        Request.post('/api/affiliate/groups',
            data
        )
            .then((res) => {
                return res.json();
            })
            .then((data) => {
                console.log(data);
                if (typeof data.success !== "undefined" && data.success === true) {
                    this.updateGroups(safe_description, data);
                    cb(data);
                }
                else if (typeof data.success !== "undefined" && data.success === false) {
                    this.message('error', data.message);
                    cb(data);
                }
                else if (typeof data.errors !== "undefined" ) {
                    this.showErrors(data.errors);
                }
            })
            .catch(error => {
                console.log(error)
            });

    };

    enableUser = (e) => {

        e.preventDefault();

        if (!this.state.selected_user) {
            this.message("error", "Error, You must first select a user.");
            return false;
        }

        let data = Request.toDataForm({
            "user_id": this.state.selected_user.user_id,
            "active": "1"
        });

        let url = '';

        if (this.state.selected_user.type_id === this.AFFILIATE_USER) {
            url = '/api/affiliate/update';
        } else if (this.state.selected_user.type_id === this.PROGRAM_USER) {
            url = '/api/user/update';
        }

        console.log(this.state.selected_user);

        Request.put(url,
            data
        )
            .then((res) => {
                return res.json();
            })
            .then((data) => {
                debugger;
                console.log(data);
                if (typeof data.success !== "undefined" && data.success === true) {
                    this.message("success", data.message);
                    let newState = Object.assign({}, this.state);
                    newState.agents = newState.agents.map(agent => {
                        debugger;
                        if (this.state.selected_user.user_id === agent.user_id) {
                            agent.active = 1;
                            return agent;
                        } else {
                            return agent;
                        }
                    });
                    newState.selected_user = null;
                    this.setCheckboxes( false );
                    this.setState(newState);
                }
                else if (typeof data.success !== "undefined" && data.success === false) {
                    this.message('error', data.message);
                }
                else if (typeof data.errors !== "undefined" ) {
                    this.showErrors(data.errors);
                }
            })
            .catch(error => {
                console.log(error)
            });

    };

    disableUser = (e) => {

        e.preventDefault();

        if (!this.state.selected_user) {
            this.message("error", "Error, You must first select a user.");
            return false;
        }

        let data = Request.toDataForm({
            "user_id": this.state.selected_user.user_id,
            "active": "0"
        });

        let url = '';

        if (this.state.selected_user.type_id === this.AFFILIATE_USER) {
            url = '/api/affiliate/update';
        } else if (this.state.selected_user.type_id === this.PROGRAM_USER) {
            url = '/api/user/update';
        }

        console.log(this.state.selected_user);

        Request.put(url,
            data
        )
            .then((res) => {
                return res.json();
            })
            .then((data) => {
                debugger;
                console.log(data);
                if (typeof data.success !== "undefined" && data.success === true) {
                    this.message("success", data.message);
                    let newState = Object.assign({}, this.state);
                    debugger;
                    newState.agents = newState.agents.map(agent => {
                        debugger;
                        if (this.state.selected_user.user_id === agent.user_id) {
                            agent.active = 0;
                            return agent;
                        } else {
                            return agent;
                        }
                    });
                    newState.selected_user = null;
                    this.setCheckboxes( false );
                    this.setState(newState);
                }
                else if (typeof data.success !== "undefined" && data.success === false) {
                    this.message('error', data.message);
                }
                else if (typeof data.errors !== "undefined" ) {
                    this.showErrors(data.errors);
                }
            })
            .catch(error => {
                console.log(error)
            });
    };

    updateUser = (user, action) => {

        let data = Request.toDataForm({
            "user_id": user.user_id,
        });

        let url = '/api/super/user';


        console.log(user);

        return;


        Request.put(url,
            data
        )
            .then((res) => {
                return res.json();
            })
            .then((data) => {
                console.log(data);
                if (typeof data.success !== "undefined" && data.success === true) {
                    this.message("success", data.message);
                }
                else if (typeof data.success !== "undefined" && data.success === false) {
                    this.message('error', data.message);
                }
                else if (typeof data.errors !== "undefined" ) {
                    this.showErrors(data.errors);
                }
            })
            .catch(error => {
                console.log(error)
            });
    };

    onCheckboxChange = (user, checked) => {
        let checkboxes = Object.assign([], this.state.checkboxes);
        // uncheck all in memory
        for(let i=0; i < this.state.agents.length; i++) {
            checkboxes[this.state.agents[i].user_id] = false;
        }

        if (checked) {
            checkboxes[user.user_id] = true;
            this.setState({
                checkboxes: checkboxes,
                selected_user: user
            });
        } else {
            {
                this.setState({
                    checkboxes: checkboxes,
                    selected_user: null
                });
            }
        }
    };

    onCheckAllChange = (e) => {
        let checkboxes = Object.assign([], this.state.checkboxes);
        checkboxes = checkboxes.map( checkbox => {
            return ! checkbox
        });
        this.setState({ checkboxes });
    };

    passwordReset = (e) => {
        e.preventDefault();

        let data = Request.toDataForm({
            "affiliate_id": this.state.affiliate_id,
            "user_id": this.state.selected_user.user_id,
        });

        let url = '/api/password/super_reset';

        Request.post(url,
            data
        )
            .then((res) => {
                return res.json();
            })
            .then((data) => {
                console.log(data);
                if (typeof data.success !== "undefined" && data.success === true) {
                    this.message("success", data.message);
                }
                else if (typeof data.success !== "undefined" && data.success === false) {
                    this.message('error', data.message);
                }
                else if (typeof data.errors !== "undefined" ) {
                    this.showErrors(data.errors);
                }
            })
            .catch(error => {
                console.log(error)
            });
    };

    getActions = () => {

        let actions = [
            { 'name' : 'enable user', 'callback': this.enableUser },
            { 'name' : 'disable user', 'callback': this.disableUser },
            { 'name' : 'reset password', 'callback': this.passwordReset },
        ];

        return (
            <div className="dropdown mr-4">
                <button type="button" className="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                    Actions
                </button>
                <div className="dropdown-menu">
                    { actions.map( action => {
                        return <a className="dropdown-item" href="#" onClick={action.callback}>{ action.name.charAt(0).toUpperCase() + action.name.slice(1) }</a>;
                    })}
                </div>
            </div>

        );
    };

    render() {

        let styles = {
            checkbox: {
                textAlign: 'center'
            }
        };

        return (

            <div className="row">



                <div className="col-md-12">
                    <h4 className="heading-info mb-4">{ this.props.user.type_id === 2 ? 'Agents' : 'Agents List'}</h4>
                </div>

                <div className="col-md-12">
                    <p className="">Please note: You can only select only one user per action above. To perform an action, select one user and choose from the actions menu above.</p>
                    { this.getActions() }
                </div>

                <div className="col-md-12">

                    <div className="_fd3-table-responsive">
                        <table className="table table-striped table-bordered tablesorter">
                            <thead>
                            <tr>
                                <th style={styles.checkbox} >

                                </th>
                                <th className="sheader">First Name
                                    <a href={ this.props.pagination.path + '?sortby=fname&order=asc' + '&page=' + this.props.pagination.current_page }
                                       className="ascending" title="Ascending" />

                                    <a href={ this.props.pagination.path + '?sortby=fname&order=desc' + '&page=' + this.props.pagination.current_page }
                                       className="descending" title="Descending" />
                                </th>
                                <th className="sheader">Last Name
                                    <a href={ this.props.pagination.path + '?sortby=lname&order=asc' + '&page=' + this.props.pagination.current_page }
                                       className="ascending" title="Ascending" />

                                    <a href={ this.props.pagination.path + '?sortby=lname&order=desc' + '&page=' + this.props.pagination.current_page }
                                       className="descending" title="Descending" />
                                </th>
                                <th className="sheader">Username
                                    <a href={ this.props.pagination.path + '?sortby=email&order=asc' + '&page=' + this.props.pagination.current_page }
                                       className="ascending" title="Ascending" />

                                    <a href={ this.props.pagination.path + '?sortby=email&order=desc' + '&page=' + this.props.pagination.current_page }
                                       className="descending" title="Descending" />
                                </th>

                                <th className="sheader">Last Login
                                    <a href={ this.props.pagination.path + '?sortby=last_login&order=asc' + '&page=' + this.props.pagination.current_page }
                                       className="ascending" title="Ascending" />

                                    <a href={ this.props.pagination.path + '?sortby=last_login&order=desc' + '&page=' + this.props.pagination.current_page }
                                       className="descending" title="Descending" />
                                </th>

{/*                                <th className="sheader">Days Activated
                                    <a href={ this.props.pagination.path + '?sortby=date&order=asc' + '&page=' + this.props.pagination.current_page }
                                       className="ascending" title="Ascending" />

                                    <a href={ this.props.pagination.path + '?sortby=date&order=desc' + '&page=' + this.props.pagination.current_page }
                                       className="descending" title="Descending" />
                                </th>*/}

                                <th className="sheader">Status
                                </th>
                            </tr>
                            </thead>
                            <tbody>

                            { this.state.agents.map( agent => {
                                return <UserLine key={agent} admin={this.props.user} user={agent} groups={[]} onChange={ this.onCheckboxChange } checked={this.state.checkboxes[agent['user_id']]} onUserUpdate={ this.updateUser } onPasswordReset={ this.passwordReset } />
                            })}

                            </tbody>
                        </table>
                    </div>

                    <Pagination pagination={pagination} />

                </div>

            </div>
        );
    }
}

UsersTable.propTypes = {
    affiliate_id: PropTypes.number.isRequired,
    user: PropTypes.object.isRequired,
    agents: PropTypes.array.isRequired,
    pagination: PropTypes.array
};

UsersTable.defaultProps = {
    affiliate_id: 0,
    user: {},
    agents: [],
    pagination: []
};

export default UsersTable;

if (document.getElementById('users-table')) {
    render(
        <UsersTable user={user} agents={users} affiliate_id={affiliate_id} pagination={pagination} />,
        document.getElementById('users-table')
    );
}
