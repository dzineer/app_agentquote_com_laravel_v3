import React, { Component } from 'react';
import { render } from 'react-dom';
import PropTypes from 'prop-types';
import Request from '../../utils/FD3Request';
import message from '../../utils/FD3Messaging';
import Pagination from "./Pagination";
import AffiliateLine from "./AffiliateLine";

/** class AffiliatesTable */
class AffiliatesTable extends Component {

    constructor(props) {
        super(props);

        this.state = {
            affiliates: this.props.affiliates,
            pagination: this.props.pagination,
            checkboxes: []
        };

        this.fieldErrors = {
        };

       this.passwordReset.bind(this);
       this.onActivate.bind(this);
       this.onDeActivate.bind(this);
       this.onCheckboxChange.bind(this);
       this.onCheckAllChange.bind(this);
    }

    componentWillMount() {
        this.setCheckboxes();
        $(document).ready(function(){
            $(".dropdown-toggle").dropdown();
        });
    }

    setCheckboxes = () => {
        let checkboxes = [];

        for(let i=0; i < this.state.affiliates.length; i++) {
            checkboxes[this.state.affiliates[i].id] = false;
        }
        this.setState({
            checkboxes
        });
    };

    updateGroups = (new_group, data) => {
        let newState = Object.assign({}, this.state);
        newState.groups.push(data.group);
        this.setState(newState);
        message.success(data.message);
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

    sanitizeGroupName = (g) => {
        g = g.trim();
        g = g.replace(/[^A-Za-z0-9\s]/g,'');
        g = g.replace(/_/gi, "");
        g = g.replace(/ +(?= )/g,'');
        g = g.trim();
        return g;
    };

    onAdminAdd = (new_admin) => {

        let admin = Object.assign({}, { affiliate_id: this.state.affiliate_id}, new_admin);

        let data = Request.toDataForm(admin);

        debugger;

        let url = '/api/invites/admin/new';

        message.success("Generating admin invite...");

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
                    newState.show_admin_panel = false;
                    newState.administrators.push(data.admin);

                    this.setState( newState );
                    location.reload();

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
                debugger;
                if (typeof data.success !== "undefined" && data.success === true) {
                    this.updateGroups(safe_description, data);
                    cb(data);
                }
                else if (typeof data.success !== "undefined" && data.success === false) {
                    message.error(data.message);
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

    onCancel = () => {
        this.setState({ show_admin_panel: false });
    };

    onShowPanel = (e) => {
        e.preventDefault();
        this.setState({ show_admin_panel: true });
    };

    passwordReset = (user) => {

        debugger;

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
                    message.success(data.message);
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
                    message.success(data.message);
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

    getActions = () => {

        let actions = [
            { 'name' : 'activate', 'callback': this.onActivate },
            { 'name' : 'deactivate', 'callback': this.onDeActivate },
            { 'name' : 'password reset', 'callback': this.onPasswordReset  },
        ];

        return (
            <div className="dropdown dropdown-toggle mr-4">
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

    onCheckboxChange = (quote) => {
        let checkboxes = Object.assign([], this.state.checkboxes);
        checkboxes[quote.id] = ! checkboxes[quote.id];
        this.setState({ checkboxes });
    };

    onCheckAllChange = (e) => {
        let checkboxes = Object.assign([], this.state.checkboxes);
        checkboxes = checkboxes.map( checkbox => {
            return ! checkbox
        });
        this.setState({ checkboxes });
    };

    getHeader = () => {

        let columns = [
            { 'name' : '',          'sortable': false },
            { 'name' : 'affiliate', 'sortable': true },
            { 'name' : 'date',      'sortable': false },
            { 'name' : 'state',      'sortable': false },
        ];

        let styles = {
            checkbox: {
                textAlign: 'center'
            }
        };

        debugger;

        return (
            <thead>
            <tr>
                { columns.map( column => {

                    if (column.sortable) {
                        return (
                            <th className={"sheader"}>{ column.name.charAt(0).toUpperCase() + column.name.slice(1) }
                                <a href={ this.state.pagination.path + '?sortby=' + column.name + '&order=asc' + '&page=' + this.state.pagination.current_page }
                                   className="ascending" title="Ascending" />

                                <a href={ this.state.pagination.path + '?sortby=' + column.name + '&order=desc' +  '&page=' + this.state.pagination.current_page }
                                   className="descending" title="Descending" />
                            </th>
                        );
                    } else if(column.name.length === 0) {
                        return (
                            <th style={styles.checkbox} >
                                <input type="checkbox" className="" name="check-all" value={ true } onChange={this.onCheckAllChange} />
                            </th>
                        );
                    } else {
                        return (
                            <th className={"sheader"}>{ column.name.charAt(0).toUpperCase() + column.name.slice(1) }
                            </th>
                        );
                    }
                })}

            </tr>
            </thead>
        );
    };

    onActivate = (e) => {
        e.preventDefault();
    };

    onDeActivate = (e) => {
        e.preventDefault();
    };

    render() {

        return (

            <div className="row">

                <div className="col-md-12">
                    { this.getActions() }
                </div>

                <div className="col-md-12">

                    <div className="__fd3-table-responsive">
                        <table className="table table-striped table-bordered tablesorter">

                            { this.getHeader() }

                            <tbody>

                            { this.state.affiliates.map( affiliate => {
                                return <AffiliateLine affiliate={affiliate} onChange={ this.onGroupChange } onUserUpdate={ this.updateUser } onPasswordReset={ this.passwordReset } />
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

AffiliatesTable.propTypes = {
    affiliates: PropTypes.array.isRequired,
    pagination: PropTypes.array,
};

AffiliatesTable.defaultProps = {
    affiliates: [],
    pagination: []
};

export default AffiliatesTable;

if (document.getElementById('affiliates-table')) {
    render(
        <AffiliatesTable affiliates={affiliates} pagination={pagination} />,
        document.getElementById('affiliates-table')
    );
}
