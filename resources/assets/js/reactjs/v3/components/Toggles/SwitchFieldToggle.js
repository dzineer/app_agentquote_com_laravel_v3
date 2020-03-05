import React, {Component} from 'react';
import PropTypes from 'prop-types';

/** class SwitchFieldToggle */
class SwitchFieldToggle extends Component {
    constructor(props) {
        super(props);
        this.state = {
            states: this.props.states,
            toggle: this.props.checked
        };
        this.onToggle.bind(this);
    }

    componentDidMount() {
        debugger;
        this.setState({
            states: this.props.states,
            toggle: this.props.checked
        })
    }

    onToggle = (e) => {
        this.setState({
            toggle: !this.state.toggle
        })
    };

    render() {
        return (
            <div className="switch-field">
                <input type="radio" id="radio-one" name="switch-one" value="no" checked={ !this.state.toggle } onChange={ this.onToggle } />
                <label htmlFor="radio-one">{ this.props.states[0] }</label>
                <input type="radio" id="radio-two" name="switch-one" value="yes" checked={ this.state.toggle } onChange={ this.onToggle } />
                <label htmlFor="radio-two">{ this.props.states[1] }</label>
            </div>
        );
    }
}

SwitchFieldToggle.propTypes = {
    id: PropTypes.string,
    states: PropTypes.array.isRequired,
    className: PropTypes.string,
    checked: PropTypes.bool,
    onChange: PropTypes.func.isRequired,
};

SwitchFieldToggle.defaultProps = {
    id: '',
    states: ['Yes', 'No'],
    className: '',
    checked: false,
    onChange: () => {}
};

export default SwitchFieldToggle;
