import React, {Component} from 'react';
import PropTypes from 'prop-types';
import message from "../../utils/FD3Messaging";

/** class AffiliateLine */
class AffiliateLine extends Component {

    constructor(props) {
        super(props);
        this.state = {
            selectedGroup: null,
            selectedGroupIndex: this.props.user.group_id,
            groups: this.props.groups,
            user: this.props.user,
            edit_field: false,
            edit_fields: {
                state: {
                    new_group: false,
                    name: false,
                    email: false,
                    coupon_code: false
                }
            },
            fields: {
                new_group: '',
                name: this.props.user["name"],
                email: this.props.user["email"],
                coupon_code: this.props.user["coupon_code"]
            },
            fieldInstance: 'user_id_' + user['user_id'],
            states: {
                show: {
                    group_select: true,
                    new_group_window: false
                }
            }
        };
        this.styles = {
          passwordReset: {
              marginRight: '10px'
          }
        };
        this.groupChange.bind(this);
        this.saveGroup.bind(this);
        this.cancelGroup.bind(this);
        this.onPasswordReset.bind(this);
        this.onChange.bind(this);
        this.updateCheckbox.bind(this);
        this.updateCoupon.bind(this);
        this.onFieldChange.bind(this);
        this.updateAffiliate.bind(this);
    }

    cancelGroup = (e) => {
      e.preventDefault();
        let newState = Object.assign({}, this.state );
        newState.states.show.new_group_window = false;
        newState.states.show.group_select = true;
        this.setState( newState );
    };

    saveGroup = (new_group_name) => {

        this.props.onChange(new_group_name, this.props.user, function(data) {
            let newState = Object.assign({}, this.state );

            if (typeof data.success !== "undefined" && data.success === false) {
                return;
            }

            newState.states.show.new_group_window = false;
            newState.states.show.group_select = true;

            newState.selectedGroupIndex = data.group.id;
            this.setState(newState);

        }.bind(this));
    };

    groupChange = (e) => {

        if (e.target.value === 'Add Group') {
            let states = Object.assign({}, this.state.states );
            states.show.group_select = false;
            states.show.new_group_window = true;
            this.setState({ states });
        } else {
            this.props.onUserUpdate(this.state.user, e.target.value);
        }

    };

    updateCheckbox = (checked, ref) => {
        if (checked) {
            ref.checked = true;
        } else {
            ref.checked = false;
        }
    };

    onChange = (e) => {
        this.props.onChange(this.state.user, e.target.checked);
    };

    onPasswordReset = (e) => {
        e.preventDefault();
        this.props.onPasswordReset(this.state.user);
    };

    toggleField = (e) => {
        e.preventDefault();
        let edit_field = ! this.state.edit_field;
        this.setState({
            edit_field
        });
    };

    toggleNField = (name, e) => {
        e.preventDefault();
        debugger;
        let edit_fields = Object.assign({}, this.state.edit_fields);
        edit_fields.state[name] = ! edit_fields.state[name];
        this.setState({
            edit_fields
        });
    };

    validateField = (field, validator) => {
        return validator(field);
    };

    updateCoupon = (e) => {
        e.preventDefault();
        if (!this.validateField(this.state.fields['coupon_code'], (field) => {
            return field.length > 4;
        })) {
            message.error('Coupon code must be at least 4 characters long.');
            return;
        }

        message.success('Coupon code is being updated...');

        this.props.onCouponCodeUpdate({
            coupon_code: this.state.fields.coupon_code,
            affiliate_id: this.state.user['affiliate_id']
        });

        this.setState({
            edit_field: false
        });

    };

    updateAffiliate = (e) => {
        e.preventDefault();
        debugger;
        if (this.state.user.name !== this.state.fields.name) {
            this.props.onAffiliateUpdate({
                affiliate_id: this.state.user.affiliate_id,
                name: this.state.fields.name,
            });
            message.success('Affiliate being updated...');
        } else if (this.state.user.email !== this.state.fields.email) {
            this.props.onAffiliateUpdate({
                affiliate_id: this.state.user.affiliate_id,
                email: this.state.fields.email
            });
            message.success('Affiliate being updated...');
        } else {
            message.info('Nothing changed.');
        }

        let edit_fields = Object.assign({}, this.state.edit_fields);

        // reset all edit field states

        for(let prop in edit_fields.state) {
            edit_fields.state[prop] = false;
        }

        this.setState({
            edit_fields
        });

    };

    onFieldChange = (e) => {
        let fields = Object.assign({}, this.state.fields);
        fields[e.target.name] = e.target.value;
         this.setState({
             fields
        });
    };

    renderNField = (field) => {
        return this.state.edit_fields.state[field] &&
            <div>
                <span><form className="form-inline"><input type="text" className="form-control mr-sm-2" value={ this.state.fields[field] } name={field} onChange={ this.onFieldChange } /><input type="button" className="btn btn-primary btn-md ml-2" value="Update" onClick={ this.updateAffiliate } /><input type="button" className="btn btn-danger btn-md ml-2" value="Cancel" onClick={(e) => this.toggleNField(field, e)} /></form></span>
            </div>
    };

    renderField = () => {
        return this.state.edit_field &&
            <div>
                <span><form className="form-inline"><input type="text" className="form-control mr-sm-2" value={ this.state.fields.coupon_code } name="coupon_code" onChange={ this.onFieldChange } /><input type="button" className="btn btn-primary btn-md ml-2" value="Update" onClick={ this.updateCoupon } /><input type="button" className="btn btn-danger btn-md ml-2" value="Cancel" onClick={this.toggleField} /></form></span>
            </div>
    };

    renderReadOnly = () => {
        let style = {
          "cursor": "pointer"
        };
        return ! this.state.edit_field && <span className="link">{ this.state.fields.coupon_code }<a onClick={this.toggleField} className="mr-sm-2 edit-item" style={style} ><i className="fa fa-pencil-square-o mx-2" aria-hidden="true" /></a></span>;
    };

    renderNReadOnly = (field) => {
        let style = {
            "cursor": "pointer"
        };
        return ! this.state.edit_fields.state[field] && <span className="link">{ this.state.fields[field] }<a onClick={(e) => this.toggleNField(field, e)} className="mr-sm-2 edit-item" style={style} ><i className="fa fa-pencil-square-o mx-2" aria-hidden="true" /></a></span>;
    };

    renderNEditField = (field) => {
        return (
            <div>
                { this.renderNField(field) }
                { this.renderNReadOnly(field) }
            </div>
        );
    };

    renderEditField = () => {
        return (
            <div>
                { this.renderField() }
                { this.renderReadOnly() }
            </div>
        );
    };

    render() {
        let styles = {
            checkbox: {
            }
        };

        return (
            <tr>
                <td style={styles.checkbox} className="line-checkbox" >
                    <input type="checkbox" className="user-checkbox" value={ this.state.user["user_id"] } checked={ this.props.checked } onClick={this.onChange} ref={this.state.fieldInstance} />
                </td>
                <td>
                    { this.renderNEditField('name') }
                </td>

                <td>
                    { this.renderNEditField('email') }
                </td>

                <td className="font-medium link"> { this.renderEditField() }</td>

                <td className="font-medium"> { this.state.user["last_login_at"] }</td>

                <td className="font-medium"> { this.state.user["active"] === 1 ? 'Enabled' : 'Disabled' }</td>
            </tr>
        );
    }
}

AffiliateLine.propTypes = {
    /** myProp */
    admin: PropTypes.object.isRequired,
    user: PropTypes.array.isRequired,
    groups: PropTypes.array.isRequired,
    checked: PropTypes.bool,
    onChange: PropTypes.func.isRequired,
    onAffiliateUpdate: PropTypes.func.isRequired,
    onPasswordReset: PropTypes.func.isRequired,
    onCouponCodeUpdate: PropTypes.func.isRequired,
};

AffiliateLine.defaultProps = {
    admin: {},
    user: [],
    groups: [],
    checked: false,
    onChange: () => {},
    onAffiliateUpdate: () => {},
    onPasswordReset: () => {},
    onCouponCodeUpdate: () => {},
};

export default AffiliateLine;
