import React, {Component} from 'react';
import PropTypes from 'prop-types';

/** class DataPagination */
class DataPagination extends Component {
    constructor(props) {
        super(props);
        this.state = {
            pagination: null
        };

        this.onFirst.bind(this);
        this.onNext.bind(this);
        this.onPrevious.bind(this);
        this.onLast.bind(this);
        this.onPage.bind(this);

    }

    componentDidMount() {
        debugger;
        this.setState({
            pagination: this.props.pagination
        })
    }

    getPrevious = () => {

        if (this.props.pagination.previous_page === null ) {
            return (
                <li key={'previous'} className="page-item disabled" aria-disabled="true" aria-label="‹ Previous">
                    <span className="page-link" aria-hidden="true"> ‹ </span>
                </li>
            );
        }
        else {
            return (
                <span className="page-item" aria-hidden="true" aria-label="« Previous" onClick={ (e) => this.onPrevious(e, this.state.pagination.previous_page) } >
                    <a className="page-link" href={this.props.pagination.previous_page} > ‹ </a>
                </span>
            );

        }
    };

    getFirst = () => {
        return <span className="page-item" aria-hidden="true" aria-label="‹ First" onClick={ (e) => this.onFirst(e, 1) }>
                  <a className="page-link" >«</a>
               </span>
    };

    getLast = () => {
        return <span className="page-item" aria-hidden="true" aria-label="« Last" onClick={ (e) => this.onLast(e, this.state.pagination.last_page) }>
                  <a className="page-link" >»</a>
               </span>
    };

    getNext = () => {

        if (this.state.pagination.next_page === null ) {
            return (
                <li key={'next_page_url'} className="page-item disabled" aria-disabled="true" aria-label="Next ›">
                    <span className="page-link" aria-hidden="true"> › </span>
                </li>
            );
        }
        else {
            return (
                <span className="page-item" aria-hidden="true" onClick={ (e) => this.onNext(e, this.state.pagination.next_page) } >
                    <a className="page-link" rel="next" aria-label="Next »"> › </a>
                </span>
            );

        }
    };

    onFirst = (e, page) => {
        e.preventDefault();
        return this.props.onFirst( page );
    };

    onNext = (e, page) => {
        e.preventDefault();
        return this.props.onNext( page );
    };

    onPrevious = (e, page) => {
        e.preventDefault();
        return this.props.onPrevious( page );
    };

    onLast = (e, page) => {
        e.preventDefault();
        return this.props.onLast( page );
    };

    onPage = (e, page) => {
        debugger;
        e.preventDefault();
        return this.props.onPage( page );
    };

    getItems = () => {

        // get 1... to this.props.pagination.total values
        debugger;
        let arr = Array.apply(null, {length: this.state.pagination.last_page}).map(function(value, index){
            return index + 1;
        });


        let first = this.getFirst();
        let prev = this.getPrevious();
        let next = this.getNext();
        let last = this.getLast();

        let items = arr.map(item => {

            if (item === this.state.pagination.current_page) {
                return <li className="page-item active" key={item}><span className="page-link">{ item }<span className="sr-only">(current)</span></span></li>;
            } else  {
                return <li className="page-item" key={item} onClick={ (e) => { this.onPage( e, item ) } }><a className="page-link" href={ item }>{ item }</a></li>
            }
        });

        return [...[first], ...[prev], ...items, ...[next], ...[last]];

    };

    render() {
        if ( ! this.state.pagination )
            return null;

        return (

            <ul className="pagination" role="navigation justify-content-center">
                { this.getItems () }
            </ul>

        );
    }
}

DataPagination.propTypes = {
    pagination: PropTypes.object.isRequired,
    onFirst: PropTypes.func.isRequired,
    onPrevious: PropTypes.func.isRequired,
    onNext: PropTypes.func.isRequired,
    onLast: PropTypes.func.isRequired,
    onPage: PropTypes.func.isRequired,
};

DataPagination.defaultProps = {
    pagination: {}
};

export default DataPagination;
