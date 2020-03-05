import React, {Component} from 'react';
import PropTypes from 'prop-types';

/** class QuoteResults */
class QuoteResults extends Component {
    constructor(props) {
        super(props);
        this.state = {
        };
    }

    render() {
        const children = this.props.children;
        const showView = this.props.show;
        const header = {
            color: '#666666',
            marginBottom: '20px'
        };

        return (
            <div>
                { children && <h3 className="text-center" style={header}>Quote Results</h3> }
                { children }
            </div>
        );
    }
}

QuoteResults.propTypes = {
    children: PropTypes.array.isRequired,
    show: PropTypes.bool,
};

QuoteResults.defaultProps = {
    children: {},
    show: true
};

export default QuoteResults;