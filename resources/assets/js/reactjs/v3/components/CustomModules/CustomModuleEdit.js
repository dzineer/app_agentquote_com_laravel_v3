import React, {Component} from 'react';
import PropTypes from 'prop-types';

/** class CustomModuleEdit */
class CustomModuleEdit extends Component {
    constructor(props) {
        super(props);
        this.state = {
            methods: {
                GET: [
                    'id',
                ],
            }
        };
    }

    render() {
        return (
            <div>

            </div>
        );
    }
}

CustomModuleEdit.propTypes = {
    /** myProp */
    //myProp: PropTypes.string.isRequired
};

CustomModuleEdit.defaultProps = {
    //myProp: val
};

export default CustomModuleEdit;
