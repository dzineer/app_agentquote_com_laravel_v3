import React, { Component } from 'react';
import { render } from 'react-dom';
import PropTypes from 'prop-types';
import toastr from 'toastr';
import Request from '../../utils/FD3Request';
import message from "../../utils/FD3Messaging";
import NewManagerPanel from "./NewManagerPanel";
import Pagination from "./Pagination";
import ManagerLine from "./ManagerLine";

/** class ManagersTable */
class ManagersTable extends Component {

    constructor(props) {
        super(props);

        this.state = {
            affiliate_id: this.props.affiliate_id,
            groups: this.props.groups,
            show_manager_panel: false,
            managers: this.props.managers
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

       this.onGroupChange.bind(this);
       this.onManagerAdd.bind(this);
       this.passwordReset.bind(this);
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

    onCancel = () => {
        this.setState({ show_manager_panel: false });
    };

    onShowPanel = (e) => {
        e.preventDefault();
        this.setState({ show_manager_panel: true });
    };

    passwordReset = (user) => {

        let data = Request.toDataForm({
            "affiliate_id": this.state.affiliate_id,
            "user_id": user.user_id,
        });

        let url = '/api/password/reset';

        message.success("Requesting reset password...");

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

    onManagerAdd = (new_manager) => {

        let admin = Object.assign({}, { affiliate_id: this.state.affiliate_id}, new_manager);

        let data = Request.toDataForm(admin);

        debugger;

        let url = '/api/invites/manager/new';

        message.success("Generating manager invite...");

        Request.post(url,
            data
        )
            .then((res) => {
                return res.json();
            })
            .then((data) => {
                console.log(data);
                if (typeof data.success !== "undefined" && data.success === true) {
                    debugger;
                    message.success(data.message);

                    let newState = Object.assign({}, this.state);
                    newState.show_manager_panel = false;
                    newState.managers.push(data.manager);

                    this.setState( newState );

                }
                else if (typeof data.success !== "undefined" && data.success === false) {
                    message.error(data.message);
                }
                else if (typeof data.errors !== "undefined" ) {
                    this.showErrors(data.errors);
                }
            })
            .catch(error => {
                console.log(error)
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

        message.success("Updating group name...");

        Request.post('/api/affiliate/groups',
            data
        )
            .then((res) => {
                return res.json();
            })
            .then((data) => {
                console.log(data);
                if (typeof data.success !== "undefined" && data.success === true) {
                    debugger;
                    this.updateGroups(safe_description, data);
                    cb(data);
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

    updateManager = (manager) => {

        let data = Request.toDataForm(manager);

        let url = '/api/affiliate/manager';

        console.log("manager", manager);

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
                    message.error(data.message);
                }
                else if (typeof data.errors !== "undefined" ) {
                    this.showErrors(data.errors);
                }
            })
            .catch(error => {
                console.log(error)
            });
    };

    updateUser = (user, group_id) => {

        let data = Request.toDataForm({
            "affiliate_id": this.state.affiliate_id,
            "user_id": user.user_id,
        });

        let url = '/api/affiliate/user/groups/'+group_id;

        message.success("Reassigning user's group...");

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
                else if (typeof data.success !== "undefined" && data.success === true) {
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

    render() {

        return (

            <div className="row">

                {
                    ! this.state.show_manager_panel && <div className="col-md-12">
                        <a href="#" className="btn btn-secondary my-20" onClick={this.onShowPanel}>+Add Manager</a>
                    </div>
                }

                <NewManagerPanel show={this.state.show_manager_panel} onCancel={this.onCancel} onNewAdmin={this.onManagerAdd} />
                <div className="col-md-12">
                    <h4 className="heading-info">Managers</h4>
                </div>
                <div className="col-md-12">

                    <div className="_fd3-table-responsive">

                        <table className="table table-striped table-bordered tablesorter">
                            <thead>
                            <tr>
                                <th className={"sheader"}>First Name
                                    <a href={ this.props.pagination.path + '?sortby=fname&order=asc' + '&page=' + this.props.pagination.current_page }
                                       className="ascending" title="Ascending" />

                                    <a href={ this.props.pagination.path + '?sortby=fname&order=desc' + '&page=' + this.props.pagination.current_page }
                                       className="descending" title="Descending" />
                                </th>
                                <th className={"sheader"}>Last Name
                                    <a href={ this.props.pagination.path + '?sortby=lname&order=asc' + '&page=' + this.props.pagination.current_page }
                                       className="ascending" title="Ascending" />

                                    <a href={ this.props.pagination.path + '?sortby=lname&order=desc' + '&page=' + this.props.pagination.current_page }
                                       className="descending" title="Descending" />
                                </th>
                                <th className={"sheader"}>Username
                                    <a href={ this.props.pagination.path + '?sortby=email&order=asc' + '&page=' + this.props.pagination.current_page }
                                       className="ascending" title="Ascending" />

                                    <a href={ this.props.pagination.path + '?sortby=email&order=desc' + '&page=' + this.props.pagination.current_page }
                                       className="descending" title="Descending" />
                                </th>
                                <th className={"sheader"}>Group
                                    <a href={ this.props.pagination.path + '?sortby=group&order=asc' + '&page=' + this.props.pagination.current_page }
                                       className="ascending" title="Ascending" />

                                    <a href={ this.props.pagination.path + '?sortby=group&order=desc' + '&page=' + this.props.pagination.current_page }
                                       className="descending" title="Descending" />
                                </th>
{/*                                <th className={"sheader"}>Days Activated
                                    <a href={ this.props.pagination.path + '?sortby=date&order=asc' + '&page=' + this.props.pagination.current_page }
                                       className="ascending" title="Ascending" />

                                    <a href={ this.props.pagination.path + '?sortby=date&order=desc' + '&page=' + this.props.pagination.current_page }
                                       className="descending" title="Descending" />
                                </th>*/}
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>

                            { this.state.managers.map( manager => {
                                return <ManagerLine user={manager} groups={this.state.groups} onChange={ this.onGroupChange } onManagerUpdate={ this.updateManager }  onPasswordReset={ this.passwordReset } />
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

ManagersTable.propTypes = {
    affiliate_id: PropTypes.number.isRequired,
    managers: PropTypes.array.isRequired,
    onManagerUpdate: PropTypes.func.isRequired,
    groups: PropTypes.array.isRequired,
    pagination: PropTypes.array,
};

ManagersTable.defaultProps = {
    affiliate_id: 0,
    managers: [],
    onManagerUpdate: () => {},
    groups: [],
    pagination: []
};

export default ManagersTable;

if (document.getElementById('managers-table')) {
    render(
        <ManagersTable managers={users} groups={groups} affiliate_id={affiliate_id} pagination={pagination} />,
        document.getElementById('managers-table')
    );
}
