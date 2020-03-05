import React, { Component } from 'react';
import { render } from 'react-dom';
import PropTypes from 'prop-types';
import toastr from 'toastr';
import Request from '../../utils/FD3Request';
import Pagination from "./Pagination";
import AffiliateLine from "./AffiliateLine";
import message from "../../utils/FD3Messaging";
import password from "../../utils/FD3Password";

/** class AffiliatesTable */
class AffiliatesTable extends Component {

    constructor(props) {
        super(props);

        this.state = {
            affiliate_id: this.props.affiliate_id,
            fields: {
                name: '',
                fname: '',
                lname: '',
                email: '',
                password: '',
                code: '',
            },
            agents: this.props.agents,
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
            'fname': (field) => {
                let fieldName = 'First name';
                let success = field.length > 2;
                return {
                    success: success,
                    message: fieldName + ' must be 2 or more characters'
                };
            },
            'lname': (field) => {
                let fieldName = 'Last name';
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
            'password': (field) => {
                let fieldName = 'Password';
                let success = field.length > 2;
                return {
                    success: success,
                    message: fieldName + ' must be 2 or more characters'
                };
            },
            'code': (field) => {
                let fieldName = 'Coupon code';
                let success = field.length > 2;
                return {
                    success: success,
                    message: fieldName + ' must be 2 or more characters'
                };
            },
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
       this.onShowPanel.bind(this);
       this.onCancel.bind(this);
       this.onSave.bind(this);
       this.onSaveNewAffiliate.bind(this);
       this.couponUpdate.bind(this);
       this.generatePassword.bind(this);
       this.passwordReset.bind(this);
       this.sendCouponCode.bind(this);
       this.updateAffiliate.bind(this);
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

    setCheckboxesAndUnselectUser = (checked) => {
        let newState = Object.assign({}, this.state);

        newState.selected_user = null;

        for(let i=0; i < this.state.agents.length; i++) {
            newState.checkboxes[this.state.agents[i].user_id] = checked;
        }

        this.setState(newState);
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
                    this.setCheckboxesAndUnselectUser(false);
                }
                else if (typeof data.success !== "undefined" && data.success === false) {
                    message.error(data.message);
                    this.setCheckboxesAndUnselectUser(false);
                }
                else if (typeof data.errors !== "undefined" ) {
                    this.showErrors(data.errors);
                    this.setCheckboxesAndUnselectUser(false);
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
                    this.setCheckboxesAndUnselectUser(false);
                }
                else if (typeof data.success !== "undefined" && data.success === false) {
                    message.error(data.message);
                    this.setCheckboxesAndUnselectUser(false);
                }
                else if (typeof data.errors !== "undefined" ) {
                    this.showErrors(data.errors);
                    this.setCheckboxesAndUnselectUser(false);
                }
            })
            .catch(error => {
                console.log(error)
            });
    };

    updateAffiliate = (affiliate) => {

        let data = Request.toDataForm(affiliate);

        let url = '/api/super/affiliate';

        console.log("affiliate", affiliate);

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

    sendCouponCode = (e) => {
        e.preventDefault();

        if (!this.state.selected_user) {
            this.message("error", "Error, You must first select a user.");
            return false;
        }

        let url = '/api/affiliate/code/'+this.state.selected_user.affiliate_id;

        message.success("Sending affiliate code...");

        Request.get(url
        )
            .then((res) => {
                return res.json();
            })
            .then((data) => {
                console.log(data);
                if (typeof data.success !== "undefined" && data.success === true) {
                    message.success(data.message);
                    this.setCheckboxesAndUnselectUser(false);
                }
                else if (typeof data.success !== "undefined" && data.success === false) {
                    message.error(data.message);
                    this.setCheckboxesAndUnselectUser(false);
                }
                else if (typeof data.errors !== "undefined" ) {
                    this.showErrors(data.errors);
                    this.setCheckboxesAndUnselectUser(false);
                }
            })
            .catch(error => {
                console.log(error)
            });
    };

    passwordReset = (e) => {
        e.preventDefault();

        console.log("state: ", this.state);

        if (!this.state.selected_user) {
            this.message("error", "Error, You must first select a user.");
            return false;
        }

        let data = Request.toDataForm({
            "user_id": this.state.selected_user.user_id,
        });

        let url = '/api/password/super_reset';

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
                    this.setCheckboxesAndUnselectUser(false);
                }
                else if (typeof data.success !== "undefined" && data.success === false) {
                    message.error(data.message);
                    this.setCheckboxesAndUnselectUser(false);
                }
                else if (typeof data.errors !== "undefined" ) {
                    this.showErrors(data.errors);
                    this.setCheckboxesAndUnselectUser(false);
                }
            })
            .catch(error => {
                console.log(error)
            });
    };

    validateField = (field, validator) => {
        return validator(field);
    };

    onSaveNewAffiliate = (e) => {

        e.preventDefault();

        let data = Request.toDataForm(this.state.fields);

        let url = '/api/affiliate/store';

        message.success("Adding new basic affiliate...");

        for(let field in this.state.fields) {
            let res = this.validateField(this.state.fields[ field ], this.validators[field]);
            if (!res.success) {
                message.error(res.message);
                return false;
            }
        }

        Request.post(url,
            data
        )
            .then((res) => {
                return res.json();
            })
            .then((data) => {
                // console.log(data);
                this.setState({ show_panel: false });
                if (typeof data.success !== "undefined" && data.success === true) {
                    message.success(data.message);
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

    couponUpdate = (coupon) => {

        let data = Request.toDataForm({
            'code': coupon.coupon_code
        });

        let url = '/api/affiliate/code/'+coupon.affiliate_id;

        message.success("Updating coupon code...");

        Request.put(url,
            data
        )
            .then((res) => {
                return res.json();
            })
            .then((data) => {
                console.log(data);
                // this.setState({ show_panel: false });
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

    generatePassword = (e) => {
        e.preventDefault();
        let pass = password.generate(16);
        let fields = Object.assign({}, this.state.fields);
        fields[ "password" ] = pass;
        this.setState({
            fields
        });
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
                <a href="#" className="btn btn-secondary my-20" onClick={this.onShowPanel}>+Add Affiliate</a>
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
                    <h4 className="heading-info mb-4">{ this.props.user.type_id === 2 ? 'Agents' : 'Affiliates'}</h4>
                </div>

                <div className="col-md-12">
                    <p className="">Please note: You can only select only one user per action above. To perform an action, select one user and choose from the actions menu above.</p>
                    { this.getActions() }
                </div>

                {this.state.show_panel &&
                    <div className="col-md-12">
                        <div style={styles.formContainer}>
                            <div className="form-group">
                                <label htmlFor="name">Affiliate Name:</label>
                                <input type="text" className="form-control" id="name" placeholder="Enter affiliate name"
                                       name="name" required onChange={this.onChange} value={ this.state.fields.name } />
                                <div className="valid-feedback">Valid.</div>
                                <div className="invalid-feedback">Please fill out this field.</div>
                            </div>
                            <div className="form-group">
                                <label htmlFor="fname">First name:</label>
                                <input type="text" className="form-control" id="fname" placeholder="Enter first name"
                                       name="fname" required onChange={this.onChange} value={ this.state.fields.fname } />
                                <div className="valid-feedback">Valid.</div>
                                <div className="invalid-feedback">Please fill out this field.</div>
                            </div>
                            <div className="form-group">
                                <label htmlFor="lname">Last name:</label>
                                <input type="text" className="form-control" id="lname" placeholder="Enter last name"
                                       name="lname" required onChange={this.onChange} value={ this.state.fields.lname } />
                                <div className="valid-feedback">Valid.</div>
                                <div className="invalid-feedback">Please fill out this field.</div>
                            </div>
                            <div className="form-group">
                                <label htmlFor="email">Email:</label>
                                <input type="text" className="form-control" id="email" placeholder="Enter email address"
                                       name="email" required onChange={this.onChange} value={ this.state.fields.email } />
                                <div className="valid-feedback">Valid.</div>
                                <div className="invalid-feedback">Please fill out this field.</div>
                            </div>

                            <div className="form-group">
                                <label htmlFor="password">Password:</label>
                                <form className="form-inline">
                                    <div className="mb-2 mr-2">
                                        <label htmlFor="password" className="sr-only">Password</label>
                                        <input type="text" className="form-control" id="password"
                                               placeholder="Password" value={ this.state.fields.password } required />
                                    </div>
                                    <button type="submit" className="btn btn-primary mb-2" onClick={ this.generatePassword }>Generate Password</button>
                                </form>
                            </div>

                            <div className="form-group">
                                <label htmlFor="code">Coupon Code:</label>
                                <input type="text" className="form-control" id="code" placeholder="Enter coupon code"
                                       name="code" required onChange={this.onChange} value={this.state.fields.code} />
                                <div className="valid-feedback">Valid.</div>
                                <div className="invalid-feedback">Please fill out this field.</div>
                            </div>
                            <button type="submit" className="btn btn-secondary mr-2" onClick={this.onSaveNewAffiliate}>Save</button> <a href="#" className="btn btn-danger" onClick={this.onCancel}>Cancel</a>
                        </div>

                    </div>
                }
                { ! this.state.show_panel &&
                <div className="col-md-12">

                    <div className="_fd3-table-responsive">
                        <table className="table table-striped table-bordered tablesorter affiliates-list">
                            <thead>
                            <tr>
                                <th style={styles.checkbox} >

                                </th>
                                <th className="sheader">Name
                                    <a href={ this.props.pagination.path + '?sortby=fname&order=asc' + '&page=' + this.props.pagination.current_page }
                                       className="ascending" title="Ascending" />

                                    <a href={ this.props.pagination.path + '?sortby=fname&order=desc' + '&page=' + this.props.pagination.current_page }
                                       className="descending" title="Descending" />
                                </th>
                                   <th className="sheader">Username
                                    <a href={ this.props.pagination.path + '?sortby=email&order=asc' + '&page=' + this.props.pagination.current_page }
                                       className="ascending" title="Ascending" />

                                    <a href={ this.props.pagination.path + '?sortby=email&order=desc' + '&page=' + this.props.pagination.current_page }
                                       className="descending" title="Descending" />
                                </th>

                                <th className="sheader">Coupon Code
                                </th>

                                <th className="sheader">Last Login
                                    <a href={ this.props.pagination.path + '?sortby=last_login&order=asc' + '&page=' + this.props.pagination.current_page }
                                       className="ascending" title="Ascending" />

                                    <a href={ this.props.pagination.path + '?sortby=last_login&order=desc' + '&page=' + this.props.pagination.current_page }
                                       className="descending" title="Descending" />
                                </th>

                                <th className="sheader">Status
                                </th>
                            </tr>
                            </thead>
                            <tbody>

                            { this.state.agents.map( agent => {
                                return <AffiliateLine key={agent} admin={this.props.user} user={agent} groups={[]} onChange={ this.onCheckboxChange } checked={this.state.checkboxes[agent['user_id']]} onAffiliateUpdate={ this.updateAffiliate } onPasswordReset={ this.passwordReset } onCouponCodeUpdate={ this.couponUpdate } />
                            })}

                            </tbody>
                        </table>
                    </div>

                    <Pagination pagination={pagination} />

                </div> }

            </div>
        );
    }
}

AffiliatesTable.propTypes = {
    affiliate_id: PropTypes.number.isRequired,
    user: PropTypes.object.isRequired,
    agents: PropTypes.array.isRequired,
    pagination: PropTypes.array
};

AffiliatesTable.defaultProps = {
    affiliate_id: 0,
    user: {},
    agents: [],
    pagination: []
};

export default AffiliatesTable;

if (document.getElementById('affiliates-table')) {
    render(
        <AffiliatesTable user={user} agents={users} affiliate_id={affiliate_id} pagination={pagination} />,
        document.getElementById('affiliates-table')
    );
}
