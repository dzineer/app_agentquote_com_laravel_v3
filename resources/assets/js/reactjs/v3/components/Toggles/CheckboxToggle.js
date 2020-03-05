import React, {Component} from 'react';
import PropTypes from 'prop-types';

/** class CheckboxToggle */
class CheckboxToggle extends Component {
    constructor(props) {
        super(props);
        this.state = {};
    }

    render() {
        return (
            <div className="fd3-cb-toggle">
                {/*<legend>Toggles</legend>*/}
                <div>
                    <input type="checkbox" id="mytoggle" />
                    <label htmlFor="mytoggle" />
                </div>
            </div>
        );
    }
}

CheckboxToggle.propTypes = {
    id: PropTypes.string,
    className: PropTypes.string,
    checked: PropTypes.bool,
    onChange: PropTypes.func.isRequired,
};

CheckboxToggle.defaultProps = {
    id: '',
    className: '',
    checked: false,
    onChange: () => {}
};

export default CheckboxToggle;
