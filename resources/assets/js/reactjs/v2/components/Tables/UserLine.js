import React, {Component} from 'react';
import PropTypes from 'prop-types';

/** class UserLine */
class UserLine extends Component {

    constructor(props) {
        super(props);
        this.state = {
            selectedGroup: null,
            selectedGroupIndex: this.props.user.group_id,
            groups: this.props.groups,
            user: this.props.user,
            fields: {
                new_group: ''
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
        debugger;
        this.props.onPasswordReset(this.state.user);
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
                <td>
                    <span className="font-medium link">{this.state.user["fname"]}</span>
                </td>

                <td>
                    {this.state.user["lname"]}
                </td>

                <td>
                    <a mailto={this.state.user["email"]} className="font-medium link">{this.state.user["email"]}</a>
                </td>

                <td> { this.state.user["last_login_at"] }</td>
                {/*<td> { this.state.user["created_at"] }</td>*/}
                <td> { this.state.user["active"] === 1 ? 'Enabled' : 'Disabled' }</td>
            </tr>
        );
    }
}

UserLine.propTypes = {
    /** myProp */
    admin: PropTypes.object.isRequired,
    user: PropTypes.array.isRequired,
    groups: PropTypes.array.isRequired,
    checked: PropTypes.bool,
    onChange: PropTypes.func.isRequired,
    onUserUpdate: PropTypes.func.isRequired,
    onPasswordReset: PropTypes.func.isRequired,
};

UserLine.defaultProps = {
    admin: {},
    user: [],
    groups: [],
    checked: false,
    onChange: () => {},
    onUserUpdate: () => {},
    onPasswordReset: () => {},
};

export default UserLine;
