import React, {Component} from 'react';
import PropTypes from 'prop-types';

/** class Pagination */
class Pagination extends Component {
    constructor(props) {
        super(props);
        this.state = {};
    }

    getPrevious = () => {

        if (this.props.pagination.prev_page_url === null ) {
            return (
                <li className="page-item disabled" aria-disabled="true" aria-label="« Previous">
                    <span className="page-link" aria-hidden="true">‹</span>
                </li>
            );
        }
        else {
            return (
                <span className="page-item" aria-hidden="true" aria-label="« Previous">
                    <a className="page-link" href={this.props.pagination.next_page_url}>‹</a>
                </span>
            );

        }
    };

    getNext = () => {

        if (this.props.pagination.next_page_url === null ) {
            return (
                <li className="page-item disabled" aria-disabled="true" aria-label="Next »">
                    <span className="page-link" aria-hidden="true">›</span>
                </li>
            );
        }
        else {
            return (
                <span className="page-item" aria-hidden="true">
                    <a className="page-link" href={this.props.pagination.next_page_url} rel="next" aria-label="Next »">›</a>
                </span>
            );

        }
    };

    getItems = () => {

        // get 1... to this.props.pagination.total values
        let arr = Array.apply(null, {length: this.props.pagination.last_page}).map(function(value, index){
            return index + 1;
        });

        let prev = this.getPrevious();
        let next = this.getNext();

        let items = arr.map(item => {

            if (item === this.props.pagination.current_page) {
                return <li className="page-item active"><span className="page-link">{ item }<span className="sr-only">(current)</span></span></li>;
            } else  {
                return <li className="page-item"><a className="page-link" href={this.props.pagination.pages[item]}>{ item }</a></li>
            }
        });

        return [...[prev], ...items, ...[next]];

    };

    render() {
        return (

            <ul className="pagination" role="navigation justify-content-center">
                { this.getItems () }
            </ul>

        );
    }
}

Pagination.propTypes = {
    pagination: PropTypes.object.isRequired
};

Pagination.defaultProps = {
    pagination: {}
};

export default Pagination;