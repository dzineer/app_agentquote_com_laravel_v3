import React, { Component } from 'react';
import { render } from 'react-dom';
import PropTypes from 'prop-types';
import toastr from 'toastr';
import UserLine from "./UserLine";
import Request from '../../utils/FD3Request';
import Pagination from "./Pagination";

/** class AgentsTable */
class AgentsTable extends Component {

    constructor(props) {
        super(props);
        debugger;
        this.state = {
            affiliate_id: this.props.affiliate_id,
            groups: this.props.groups
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

    updateUser = (user, group_id) => {

        let data = Request.toDataForm({
            "affiliate_id": this.state.affiliate_id,
            "user_id": user.user_id,
        });

        let url = '/api/affiliate/user/groups/'+group_id;

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

    passwordReset = (user) => {

        debugger;

        let data = Request.toDataForm({
            "affiliate_id": this.state.affiliate_id,
            "user_id": user.user_id,
        });

        let url = '/api/password/reset';

        Request.post(url,
            data
        )
            .then((res) => {
                return res.json();
            })
            .then((data) => {
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

    render() {

        return (

            <div className="row">

                <div className="col-md-12">
                    <h4 className="heading-info">Agents</h4>
                </div>
                <div className="col-md-12">

                    <div className="_fd3-table-responsive">
                        <table className="table table-striped table-bordered tablesorter">
                            <thead>
                            <tr>
                                <th className="sheader can-hide-on-sm">First Name
                                    <a href={ this.props.pagination.path + '?sortby=fname&order=asc' + '&page=' + this.props.pagination.current_page }
                                       className="ascending" title="Ascending" />

                                    <a href={ this.props.pagination.path + '?sortby=fname&order=desc' + '&page=' + this.props.pagination.current_page }
                                       className="descending" title="Descending" />
                                </th>
                                <th className="sheader can-hide-on-sm">Last Name
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
                                { this.props.user.type_id !== 4  ?
                                    <th className="sheader">Group
                                        <a href={ this.props.pagination.path + '?sortby=group&order=asc' + '&page=' + this.props.pagination.current_page }
                                           className="ascending" title="Ascending" />

                                        <a href={ this.props.pagination.path + '?sortby=group&order=desc' + '&page=' + this.props.pagination.current_page }
                                           className="descending" title="Descending" />
                                    </th>
                                    : '' }
{/*                                <th className="sheader">Days Activated
                                    <a href={ this.props.pagination.path + '?sortby=date&order=asc' + '&page=' + this.props.pagination.current_page }
                                       className="ascending" title="Ascending" />

                                    <a href={ this.props.pagination.path + '?sortby=date&order=desc' + '&page=' + this.props.pagination.current_page }
                                       className="descending" title="Descending" />
                                </th>*/}
                                {/*<th className="sheader">Actions</th>*/}
                            </tr>
                            </thead>
                            <tbody>

                            { this.props.agents.map( agent => {
                                return <UserLine key={this.props.user} admin={this.props.user} user={agent} groups={this.state.groups} onChange={ this.onGroupChange } onUserUpdate={ this.updateUser } onPasswordReset={ this.passwordReset } />
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

AgentsTable.propTypes = {
    affiliate_id: PropTypes.number.isRequired,
    user: PropTypes.object.isRequired,
    agents: PropTypes.array.isRequired,
    groups: PropTypes.array.isRequired,
    pagination: PropTypes.array
};

AgentsTable.defaultProps = {
    affiliate_id: 0,
    user: {},
    agents: [],
    groups: [],
    pagination: []
};

export default AgentsTable;

if (document.getElementById('agents-table')) {
    render(
        <AgentsTable user={user} agents={users} groups={groups} affiliate_id={affiliate_id} pagination={pagination} />,
        document.getElementById('agents-table')
    );
}
