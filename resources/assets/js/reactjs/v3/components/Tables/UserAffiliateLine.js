import React, {Component} from 'react';
import PropTypes from 'prop-types';
import message from "../../utils/FD3Messaging";

/** class UserAffiliateLine */
class UserAffiliateLine extends Component {

    constructor(props) {
        super(props);
        this.state = {
            selectedGroup: null,
            selectedGroupIndex: this.props.user.group_id,
            groups: this.props.groups,
            user: this.props.user,
            affiliates: this.props.affiliates,
            edit_field: false,
            confirming: false,
            messages: {
                confirm: '',
                updating: '',
            },
            affiliate_name: '',
            fields: {
                new_group: '',
                affiliate_id: this.props.user.affiliate_id,
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
        this.onFieldChange.bind(this);
        this.confirmSwitch.bind(this);
        this.switchAffiliates.bind(this);
        this.confirmUpdate.bind(this);
        this.cancelUpdate.bind(this);
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

    validateField = (field, validator) => {
        return validator(field);
    };

    confirmSwitch = (e) => {
        e.preventDefault();

        let index = this.refs.affiliate_select.selectedIndex;
        let change_to_affiliate = this.refs.affiliate_select[index].text;

        let confirm_message = "Are you sure you want change user affiliate from " + this.state.user.affiliate_name + " to " + change_to_affiliate;
        let update_message = "Updating user's affiliate from " + this.state.user.affiliate_name + " to " + change_to_affiliate;

        let newState = Object.assign({}, this.state);
        newState.edit_field = false;
        newState.confirming = true;
        newState.messages.confirm = confirm_message;
        newState.messages.updating = update_message;

        this.setState(newState);

    };

    switchAffiliates = (e) => {
        e.preventDefault();
        debugger;
        if (!this.validateField(this.state.fields['affiliate_id'], (affiliate_id) => {
            return affiliate_id !== this.state.user.affiliate_id;
        })) {
            message.error('Affiliate has not been changed.');
            return;
        }

        this.setState({
            edit_field: false,
            confirming: false
        });

        message.success(this.state.messages.updating);

        this.props.onAffiliateChange(this.state.user.user_id, this.state.fields.affiliate_id);
    };

    onFieldChange = (e) => {
        let fields = Object.assign({}, this.state.fields);
        fields[e.target.name] = e.target.value;
        this.setState({
            fields
        });
    };

    renderAffiliatesSelect = () => {
        return (
            <select key={this.state.user} className="form-control" name="affiliate_id" onChange={this.onFieldChange} ref="affiliate_select">
                {
                    this.state.affiliates.map(affiliate => {
                       return this.state.user.affiliate_id === affiliate.id ?
                        <option value={affiliate.id} selected>{affiliate.name}</option> :
                           <option value={affiliate.id}>{affiliate.name}</option>
                    })
                }
            </select>
        )
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

    cancelUpdate = (e) => {
        e.preventDefault();
        this.setState({
            edit_field: false,
            confirming: false,
            confirm_message: ''
        });
    };

    confirmUpdate = () => {
        return (
            <span><form className="form-inline">
                <label>{ this.state.messages.confirm }</label>
                <input type="button" className="btn btn-primary btn-md ml-2" value="Yes" onClick={this.switchAffiliates} />
                <input type="button" className="btn btn-danger btn-md ml-2" value="No" onClick={this.cancelUpdate} />
            </form></span>
        )
    };

    renderField = () => {
        return this.state.edit_field &&
            <div>
                <span><form className="form-inline">{ this.renderAffiliatesSelect() } <input type="button" className="btn btn-primary btn-md ml-2" value="Update" onClick={this.confirmSwitch} /><input type="button" className="btn btn-danger btn-md ml-2" value="Cancel" onClick={this.toggleField} /></form></span>
            </div>
    };

    renderReadOnly = () => {
        let style = {
            "cursor": "pointer"
        };
        return ! this.state.edit_field && <span className="font-medium link">{ this.state.user.affiliate_name }<a onClick={this.toggleField} className="mr-sm-2 edit-item" style={style} ><i className="fa fa-pencil-square-o mx-2" aria-hidden="true" /></a></span>;
    };

    renderEditField = () => {
        return (
            <div>
                { this.state.confirming && this.confirmUpdate() }
                { ! this.state.confirming && this.renderField() }
                { ! this.state.confirming && this.renderReadOnly() }
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
            <tr>
                <td style={styles.checkbox} className="line-checkbox" >
                    <input type="checkbox" className="user-checkbox" value={ this.state.user["user_id"] } checked={ this.props.checked } onClick={this.onChange} ref={this.state.fieldInstance} />
                </td>

                <td className="can-hide-on-sm">
                    <span className="font-medium link">{this.state.user["fname"]}</span>
                </td>

                <td className="can-hide-on-sm">
                    <span className="font-medium link">{this.state.user["lname"]}</span>
                </td>

                <td>
                    <span className="font-medium link"><a mailto={this.state.user["email"]} className="font-medium link">{this.state.user["email"]}</a></span>
                </td>

                <td>
                    <span className="font-medium link">{ this.renderEditField() }</span>
                </td>

                <td> { this.state.user["last_login_at"] }</td>
                {/*<td> { this.state.user["created_at"] }</td>*/}
                <td> { this.state.user["active"] === 1 ? 'Enabled' : 'Disabled' }</td>
            </tr>
        );
    }
}

UserAffiliateLine.propTypes = {
    /** myProp */
    admin: PropTypes.object.isRequired,
    user: PropTypes.array.isRequired,
    affiliates: PropTypes.array.isRequired,
    groups: PropTypes.array.isRequired,
    checked: PropTypes.bool,
    onChange: PropTypes.func.isRequired,
    onUserUpdate: PropTypes.func.isRequired,
    onAffiliateChange: PropTypes.func.isRequired,
    onPasswordReset: PropTypes.func.isRequired,
};

UserAffiliateLine.defaultProps = {
    admin: {},
    user: [],
    affiliates: [],
    groups: [],
    checked: false,
    onChange: () => {},
    onUserUpdate: () => {},
    onAffiliateChange: () => {},
    onPasswordReset: () => {},
};

export default UserAffiliateLine;
