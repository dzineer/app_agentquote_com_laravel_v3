import React, {Component} from 'react';
import PropTypes from 'prop-types';

/** class AffiliateCodeLine */
class AffiliateCodeLine extends Component {

    constructor(props) {
        super(props);
        this.state = {
            coupon: this.props.coupon,
            fields: {
                new_group: ''
            },
            edit_field: false,
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
        this.saveGroup.bind(this);
        this.cancelGroup.bind(this);
        this.onChange.bind(this);
        this.toggleField.bind(this);
    }

    toggleField = (e) => {
        e.preventDefault();
        let edit_field = ! this.state.edit_field;
        this.setState({
            edit_field
        })
    };

    onUpdateCouponCode = (e) => {
        e.preventDefault();
        let edit_field = ! this.state.edit_field;
        this.setState({
            edit_field
        })
    };

    cancelGroup = (e) => {
      e.preventDefault();
        let newState = Object.assign({}, this.state );
        newState.states.show.new_group_window = false;
        newState.states.show.group_select = true;
        this.setState( newState );
    };

    renderField = () => {
        return this.state.edit_field &&
        <div>
            <span><form className="form-inline"><input type="text" className="form-control mr-sm-2" value={ this.state.coupon.coupon_code } /><input type="button" className="btn btn-primary btn-md ml-2" value="Update" onClick={this.onUpdateCouponCode} /><input type="button" className="btn btn-danger btn-md ml-2" value="Cancel" onClick={this.toggleField} /></form></span>
        </div>
    };

    renderReadOnly = () => {
        return ! this.state.edit_field && <span className="font-medium link">{ this.state.coupon.coupon_code }</span>;
    };

    renderEditField = () => {
        return (
            <div>
                { this.renderField() }
                { this.renderReadOnly() }
            </div>
         );
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

    onChange = (e) => {
        debugger;
        this.props.onChange(this.state.user, e.target.checked);
    };

    render() {
        let styles = {
            checkbox: {
                textAlign: 'center'
            }
        };

        return (
            <tr>
                <td>
                    <span className="font-medium link">{ this.state.coupon.name }</span>
                </td>

                <td>
                    { this.renderEditField() }
                </td>

                <td>
                    <a href="#" className="font-medium link" onClick={this.toggleField}>Edit</a>
                </td>
            </tr>
        );
    }
}

AffiliateCodeLine.propTypes = {
    coupon: PropTypes.object.isRequired,
    onChange: PropTypes.func.isRequired
};

AffiliateCodeLine.defaultProps = {
    coupon: {},
    onChange: () => {}
};

export default AffiliateCodeLine;