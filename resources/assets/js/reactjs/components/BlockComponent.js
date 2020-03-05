import React, {Component} from 'react';
import PropTypes from 'prop-types';
import ReactDOM from "react-dom";
import Example from "./Example";

/** class BlockComponent */
class BlockComponent extends Component {
    constructor(props) {
        super(props);
        this.state = {};
    }

    render() {
        return (
            <div>

            </div>
        );
    }
}

BlockComponent.propTypes = {
    /** myProp */
    //myProp: PropTypes.string.isRequired
};

BlockComponent.defaultProps = {
    //myProp: val
};

export default BlockComponent;

if (document.getElementById('block-component')) {
    ReactDOM.render(<BlockComponent />, document.getElementById('block-component'));
}
