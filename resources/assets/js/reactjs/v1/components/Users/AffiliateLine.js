import React, {Component} from 'react';
import PropTypes from 'prop-types';

/** class AffiliateLine */
class AffiliateLine extends Component {

    constructor(props) {
        super(props);
        this.state = {
            affiliate: this.props.affiliate,
            fields: {
                new_group: ''
            },
            states: {
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

    onPasswordReset = (e) => {
        e.preventDefault();
        debugger;
        this.props.onPasswordReset(this.state.user);
    };

    render() {

        console.log(this.state.affiliate);

        let styles = {
            checkbox: {
                textAlign: 'center'
            }
        };

        debugger;
        return (
            <tr>
                <td style={styles.checkbox} >
                    <input type="checkbox" className="" value={ this.state.affiliate.id } checked={ this.props.checked } onChange={this.onChange} />
                </td>
                <td>
                    <span className="font-medium link">{this.state.affiliate["name"]}</span>
                </td>

                <td>{ this.state.affiliate["created_at"] }</td>
                <td>{ this.state.affiliate["active"] === 1 ? 'Active' : 'Not Active' }</td>
{/*                <td>
                    <a href="#" style={this.styles.passwordReset} onClick={this.onPasswordReset}> Password Reset </a>
                </td>*/}
            </tr>
        );
    }
}

AffiliateLine.propTypes = {
    affiliate: PropTypes.object.isRequired,
    onChange: PropTypes.func.isRequired,
    onUserUpdate: PropTypes.func.isRequired,
    onPasswordReset: PropTypes.func.isRequired,
};

AffiliateLine.defaultProps = {
    affiliate: {},
    onChange: () => {},
    onUserUpdate: () => {},
    onPasswordReset: () => {},
};

export default AffiliateLine;