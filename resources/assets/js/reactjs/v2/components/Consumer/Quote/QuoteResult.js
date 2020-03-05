import React, {Component} from 'react';
import PropTypes from 'prop-types';
import QuoteItem from "./QuoteItem";

/** class QuoteResult */
class QuoteResult extends Component {
    constructor(props) {
        super(props);
        this.state = {};
    }

    render() {

        let item = Object.assign({}, this.props.item);

        console.log("QuoteResult::render - Policy Item: ", item);

        item.Rate1Adj = item.Rate1Adj ? item.Rate1Adj : '';
        item.Rate2Adj = item.Rate2Adj ? item.Rate2Adj : '';
        item.Rate3Adj = item.Rate3Adj ? item.Rate3Adj : '';
        item.Rate4Adj = item.Rate4Adj ? item.Rate4Adj : '';

        console.log("[item]", item);

        return (
            <QuoteItem item={item} />
        );
    }
}

QuoteResult.propTypes = {
    item: PropTypes.object.isRequired,
    styles: PropTypes.object.isRequired
};

QuoteResult.defaultProps = {
    item: {},
    styles: {}
};

export default QuoteResult;