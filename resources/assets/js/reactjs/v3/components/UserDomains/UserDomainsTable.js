import React, { Component } from 'react';
import { render } from 'react-dom';
import PropTypes from 'prop-types';
import Request from '../../utils/FD3Request';
import message from '../../utils/FD3Messaging';
import Pagination from "./Pagination";
import UserDomainLine from "./UserDomainLine";
import toastr from "toastr";

/** class UserDomainsTable */
class UserDomainsTable extends Component {

    constructor(props) {
        super(props);

        this.state = {
            domains: [],
            pagination: [],
            affiliates: [],
            users: [],
            checkboxes: [],
            newPanelOpened: false,
            affiliateSelected: false,
            userSelected: false,
            selectedDomainId: 0,
            fields: {
                affiliate_id: -1,
                user_id: -1,
                domain: ''
            }
        };

        this.fieldErrors = {
        };

       this.addUserDomain.bind(this);
       this.onCheckboxChange.bind(this);
       this.onCheckAllChange.bind(this);
       this.openPanel.bind(this);
       this.onCancel.bind(this);
       this.onChange.bind(this);
       this.onRemove.bind(this);
       this.onAffiliateChange.bind(this);
       this.onAffiliatedUserChange.bind(this);
       this.loadAffiliates.bind(this);
       this.loadUsers.bind(this);
       this.renderAffiliatedUsersOptions.bind(this);
       this.renderAffiliatedUsersOptions.bind(this);
       this.load.bind(this);
    }

    componentDidMount() {

        this.setState({
            domains: this.props.domains,
            pagination: this.props.pagination
        });

        this.setCheckboxes();

        $(document).ready(function(){
            $(".dropdown-toggle").dropdown();
        });
    }

    setCheckboxes = () => {
        let checkboxes = [];

        debugger;

        for(let i=0; i < this.state.domains.length; i++) {
            checkboxes[this.state.domains[i].id] = false;
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

    checkIsValidDomain = (domain) => {
        const re = new RegExp(/^(?:[a-z0-9](?:[a-z0-9-]{0,61}[a-z0-9])?\.)+[a-z0-9][a-z0-9-]{0,61}[a-z0-9]$/);
        return domain.match(re);
    };

    onCancel = (e) => {
        e.preventDefault();
        this.setState({
            newPanelOpened: false,
            affiliateSelected: false,
            userSelected: false
        });
    };

    addUserDomain = (e) => {

        e.preventDefault();

        let fd = new FormData();

        if (!this.checkIsValidDomain( this.state.fields.domain )) {
            message.error("Invalid domain.");
            return false;
        }

        let options = {
            "affiliate_id": this.state.fields.affiliate_id,
            "user_id": this.state.fields.user_id,
            "domain": this.state.fields.domain
        };

        debugger;

        fd.append("options", JSON.stringify( options ));
        fd.append("action", "add");

        message.success("Adding User domain...");

        axios.post(url, fd).then( res => {
            console.log(res);
            debugger;
            if (res.data.success === true) {
                toastr.success('User domain added');
                this.setState({
                    newPanelOpened: false
                }, function() {
                    document.location.reload();
                });
            } else {
                toastr.error(res.data.message);
            }
        });
    };

    getActions = () => {

        let actions = [
            { 'name' : 'remove', 'callback': this.onRemove }
        ];

        return (
            <div className="dropdown m-b-10">
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

    onAffiliateChange = (e) => {
        let fields = Object.assign({}, this.state.fields);
        debugger;
        fields[ e.currentTarget.name ] = e.currentTarget.value;
        let that = this;
        this.setState({ fields, affiliateSelected: true }, () => {
         that.loadUsers();
        });
        return true;
    };

    onAffiliatedUserChange = (e) => {
        let fields = Object.assign({}, this.state.fields);
        debugger;
        fields[ e.currentTarget.name ] = e.currentTarget.value;
        let that = this;
        if (e.currentTarget.value !== "-1") {

            this.setState({ fields, userSelected: true });

        } else {

            this.setState({ fields, userSelected: false });

        }

        return true;
    };

    onChange = (e) => {
        let fields = Object.assign({}, this.state.fields);
        debugger;
        fields[ e.currentTarget.name ] = e.currentTarget.value;
        this.setState({ fields });

        return true;
    };

    onCheckboxChange = (id) => {
        let checkboxes = Object.assign([], this.state.checkboxes);
        checkboxes[id] = ! checkboxes[id];
        this.setState({ checkboxes, selectedDomainId: id });
    };

    openPanel = (e) => {
        e.preventDefault();
        this.setState({ newPanelOpened: true }, () => {
            debugger;
            this.loadAffiliates();
        });
    };

    loadAffiliates = () => {

        let options = {
            'request': 'affiliates',
        };

        this.load( options ).then( res => {
            console.log(res);
            debugger;
            if (res.data.success === true) {
                this.setState({
                    affiliates: res.data.affiliates
                });
            } else {
                toastr.error('Cannot load affiliates');
            }
        });
    };

    loadUsers = () => {

        debugger;

        if (this.state.fields.affiliate_id === "-1") {
            return false;
        }

        let options = {
            'request': 'affiliate.users',
            'affiliate_id': this.state.fields.affiliate_id
        };

        this.load( options ).then( res => {
            console.log(res);
            debugger;
            if (res.data.success === true) {
                this.setState({
                    users: res.data.users
                });
            } else {
                toastr.error('Cannot load users');
            }
        });
    };


    load = ( options ) => {

        let fd = new FormData();

        fd.append("options", JSON.stringify( options ));
        fd.append("action", "load");

        return axios.post(url, fd);
    };

    onCheckAllChange = (e) => {
        let checkboxes = Object.assign([], this.state.checkboxes);
        checkboxes = checkboxes.map( checkbox => {
            return ! checkbox
        });
        this.setState({ checkboxes });
    };

    getTableHeader = () => {

        let columns = [
            { 'name' : '', 'type': 'blank', 'sortable': false },
            { 'name' : 'user', 'type': 'field', 'sortable': false },
            { 'name' : 'domain', 'type': 'field', 'sortable': false },
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
                    if (column.type === 'blank') {
                        return <th> </th>
                    } else if (column.sortable) {
                        return (
                            <th className={"sheader"}>{ column.name.charAt(0).toUpperCase() + column.name.slice(1) }
                                <a href={ this.state.pagination.path + '?sortby=' + column.name + '&order=asc' + '&page=' + this.state.pagination.current_page }
                                   className="ascending" title="Ascending" />

                                <a href={ this.state.pagination.path + '?sortby=' + column.name + '&order=desc' +  '&page=' + this.state.pagination.current_page }
                                   className="descending" title="Descending" />
                            </th>
                        );
                    } else if (column.name.length === 0) {
                        return (
                            <th style={styles.checkbox} >
                                <input type="checkbox" className="" name="check-all" value={ true } onChange={this.onCheckAllChange} />
                            </th>
                        );
                    }
                    else {
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

    renderControls = () => {
        if (! this.state.newPanelOpened ) {
            return [this.getActions(), <button type="button" className="btn btn-secondary m-x-10" onClick={ this.openPanel } >+ Add User Domain</button>];
        }
    };

    toDisable = () => {
        return ! (this.state.affiliateSelected && this.state.userSelected);
    };

    renderAffiliateOptions = () => {
        return [ <option value="-1">Affiliates</option>,
            this.state.affiliates.map( affiliate => {
                return <option value={ affiliate.id }>{ affiliate.name }</option>
            }) ];
    };

    renderAffiliatedUsersOptions = () => {
        return [ <option value="-1">Users</option>,
            this.state.users.map( user => {
                return <option value={ user.id }>{ user.email }</option>
            }) ];
    };

    renderAddUserDomainPanel = () => {
        if ( this.state.newPanelOpened ) {
            return (
                    <div className="row"
                        style={{"padding":"20px","border":"1px solid rgba(204, 204, 204, 0.42)","margin":"14px 0px 0px","borderRadius":"5px"}}>

                        <div className="form-group col-md-4">
                            <label htmlFor="user_id">Select Affiliate:</label>

                            <select className="form-control"
                                    id="affiliate_id"
                                    name="affiliate_id"
                                    onChange={ this.onAffiliateChange }
                                    required="true">
                                {
                                    this.renderAffiliateOptions()
                                }

                            </select>

                        </div>
                        <div className="form-group col-md-4">
                            <label htmlFor="user_id">Select User:</label>

                            <select className="form-control"
                                    id="user_id"
                                    name="user_id"
                                    required="true"
                                    disabled={ ! this.state.affiliateSelected }
                                    onChange={ this.onAffiliatedUserChange } >
                                { this.renderAffiliatedUsersOptions() }
                            </select>

                        </div>

                        <div className="form-group col-md-4">
                            <label htmlFor="domain">Domain Name:</label>

                            <input type="text"
                                   className="form-control"
                                   id="domain"
                                   placeholder="Enter FQDN"
                                   name="domain"
                                   required="true"
                                   disabled={ this.toDisable() }
                                   onChange={ this.onChange }
                                   />
                        </div>

                        <div className="form-group col-md-12">

                            <a href="#" className="btn btn-danger mr-2" onClick={ this.onCancel }>Cancel</a>
                            <button type="submit" className="btn btn-secondary" disabled={ this.toDisable() || this.state.fields.domain.length < 4 } onClick={ this.addUserDomain }>Save</button>

                        </div>

                    </div>
            )
        }
    };

    renderBody = () => {

        if (! this.state.newPanelOpened ) {
            return (
                [<div className="__fd3-table-responsive">

                    <table className="table table-striped table-bordered tablesorter">

                        { this.getTableHeader() }

                        <tbody>

                        { !! this.state.domains.length && this.state.domains.map( domain => {
                            return <UserDomainLine domain={domain} onChange={ this.onCheckboxChange }  />
                        })}

                        </tbody>
                    </table>

                    { ! this.state.domains.length && <div className="text-center">No domains</div> }

                </div>]
            );

            // <Pagination pagination={ this.state.pagination } />

        } else {
            return this.renderAddUserDomainPanel();
        }

    };

    renderHeader = () => {
        return <h5 className="heading-info">User Domains</h5>;
    };

    onActivate = (e) => {
        e.preventDefault();
    };

    onRemove = (e) => {
        e.preventDefault();
        // this.state.selectedDomainId
        debugger;
        if ( this.state.selectedDomainId === 0) {
            return false;
        }

        let options = {
            "domain_id": this.state.selectedDomainId
        };

        let fd = new FormData();

        fd.append("options", JSON.stringify( options ));
        fd.append("action", "remove");

        axios.post(url, fd).then( options ).then( res => {
            console.log(res);
            debugger;
            if (res.data.success === true) {
                document.location.reload();
            } else {
                toastr.error(res.data.message);
            }
        });
    };

    render() {

        return (

            <div className="row">

                <div className="col-md-12">

                    { this.renderHeader() }

                </div>

                <div className="col-md-12">

                    { this.renderControls() }

                </div>

                <div className="col-md-12">

                    { this.renderBody() }

                </div>

            </div>
        );
    }
}

UserDomainsTable.propTypes = {
    affiliates: PropTypes.array.isRequired,
    pagination: PropTypes.array,
    actionURL: PropTypes.string.isRequired,
};

UserDomainsTable.defaultProps = {
    affiliates: [],
    pagination: [],
    actionURL: ''
};

export default UserDomainsTable;

if (document.getElementById('user-domains-table')) {
    render(
        <UserDomainsTable domains={domains} pagination={pagination} actionURL={url} />,
        document.getElementById('user-domains-table')
    );
}
