import React, { Component } from 'react';
import { render } from 'react-dom';
import PropTypes from 'prop-types';
import Request from '../../utils/FD3Request';
import message from '../../utils/FD3Messaging';
import Pagination from "./Pagination";
import QuoteLine from "./QuoteLine";

/** class QuotesReportTable */
class QuotesReportTable extends Component {

    constructor(props) {
        super(props);

        this.state = {
            user: this.props.user,
            affiliate_id: this.props.affiliate_id,
            quotes: this.props.quotes,
            pagination: this.props.pagination,
            checkboxes: []
        };

       this.quoteDelete.bind(this);
       this.onDelete.bind(this);
       this.deleteQuotes.bind(this);
       this.onCheckAllChange.bind(this);
       this.onCheckboxChange.bind(this);
       this.perPageChange.bind(this);
    }

    componentWillMount() {
        this.setCheckboxes();
    }

    setCheckboxes = () => {
        let checkboxes = [];

        for(let i=0; i < this.state.quotes.length; i++) {
            checkboxes[this.state.quotes[i].id] = false;
        }
        this.setState({
            checkboxes
        });
    };

    showErrors = (errors) => {
        let messages = '';

        for(let prop in errors) {
            if (errors.hasOwnProperty(prop)) {
                messages += "\n" + this.fieldErrors[prop];
            }
        }

        message.error(messages);
    };

    findGetParameter = (parameterName) => {
        let result = null, tmp = [];
        let items = location.search.substr(1).split("&");
        for (let index = 0; index < items.length; index++) {
            tmp = items[index].split("=");
            if (tmp[0] === parameterName) result = decodeURIComponent(tmp[1]);
        }
        return result;
    };

    quoteDelete = (quote) => {

        debugger;

        let sortBy = this.findGetParameter('sortby');
        let order = this.findGetParameter('order');

        sortBy = sortBy === null ? '' : sortBy;
        order = order === null ? '' : order;

        let data = Request.toDataForm({
            "affiliate_id": this.state.affiliate_id,
            "user_id": user.id,
            "quote_id": quote.id,
            "sortby": sortBy,
            "order": order
        });

        let url = '/api/quote/delete';

        message.success("Deleting quote...");

        Request.delete(url,
            data
        )
            .then((res) => {
                return res.json();
            })
            .then((data) => {
                console.log(data);
                if (typeof data.success !== "undefined" && data.success === true) {
                    message.success(data.message);
                    debugger;
                    this.setState({
                        'quotes': data.quotes,
                        'pagination': data.pagination,
                    })
                }
                else if (typeof data.success !== "undefined" && data.success === false) {
                    message.error(data.message);

                }
                else if (typeof data.errors !== "undefined" ) {
                    this.showErrors(data.errors);
                }
            })
            .catch(error => {
                console.log(error)
            });
    };

    deleteQuotes = (quotes) => {

        debugger;

        let sortBy = this.findGetParameter('sortby');
        let order = this.findGetParameter('order');

        sortBy = sortBy === null ? '' : sortBy;
        order = order === null ? '' : order;

        let data = Request.toDataForm({
            "affiliate_id": this.state.affiliate_id,
            "user_id": user.id,
            "quotes": JSON.stringify(quotes),
            "sortby": sortBy,
            "order": order
        });

        let url = '/api/quotes/delete';

        message.success("Deleting quotes...");

        Request.delete(url,
            data
        )
            .then((res) => {
                return res.json();
            })
            .then((data) => {
                console.log(data);
                if (typeof data.success !== "undefined" && data.success === true) {
                    message.success(data.message);
                    debugger;
                    let newState = Object.assign({}, this.state);
                    newState.quotes = data.quotes;
                    newState.pagination = data.pagination;
                    this.setState(newState);
                    this.setCheckboxes();
                    this.forceUpdate();
                }
                else if (typeof data.success !== "undefined" && data.success === false) {
                    message.error(data.message);

                }
                else if (typeof data.errors !== "undefined" ) {
                    this.showErrors(data.errors);
                }
            })
            .catch(error => {
                console.log(error)
            });
    };

    onDelete = (e) => {
        e.preventDefault();
        let toDelete = [];
        let checkboxes = Object.assign([], this.state.checkboxes);
        checkboxes.forEach( (checkbox, index) => {
            if(checkbox) {
                toDelete.push({ "quote_id" : index});
            }
        });
        console.log("To delete", toDelete);

        this.deleteQuotes(toDelete);
    };

    onCheckboxChange = (quote) => {
        let checkboxes = Object.assign([], this.state.checkboxes);
        checkboxes[quote.id] = ! checkboxes[quote.id];
        this.setState({ checkboxes });
    };

    onCheckAllChange = (e) => {
        let checkboxes = Object.assign([], this.state.checkboxes);
        checkboxes = checkboxes.map( checkbox => {
           return ! checkbox
        });
        this.setState({ checkboxes });
    };

    getHeader = () => {

        let columns = [
            { 'name' : '',      'sortable': false },
            { 'name' : 'age',      'sortable': true },
            { 'name' : 'state',    'sortable': true },
            { 'name' : 'date',    'sortable': true },
            { 'name' : 'birthdate',     'sortable': false },
            { 'name' : 'gender',   'sortable': true },
            { 'name' : 'term',     'sortable': true },
            { 'name' : 'benefit',  'sortable': true },
            { 'name' : 'category', 'sortable': true },
        ];

        let styles = {
            checkbox: {
                textAlign: 'center'
            }
        };

        return (
            <thead>
                <tr>
                    { columns.map( column => {

                        if (column.sortable) {
                            return (
                                <th className={"sheader"}>{ column.name.charAt(0).toUpperCase() + column.name.slice(1) }
                                    <a href={ this.state.pagination.path + '?sortby=' + column.name + '&order=asc' + '&page=' + this.state.pagination.current_page }
                                       className="ascending" title="Ascending" />

                                    <a href={ this.state.pagination.path + '?sortby=' + column.name + '&order=desc' +  '&page=' + this.state.pagination.current_page }
                                       className="descending" title="Descending" />
                                </th>
                            );
                        } else if(column.name.length === 0) {
                            if (this.state.user.type_id === 5) {
                                return (
                                    <th style={styles.checkbox} >
                                        <input type="checkbox" className="" name="check-all" value={ true } onChange={this.onCheckAllChange} />
                                    </th>
                                );
                            }
                        }else {
                            return (
                                <th className={"sheader"}>{ column.name.charAt(0).toUpperCase() + column.name.slice(1) }
                                </th>
                            );
                        }
                    })}

                </tr>
            </thead>
        );
    };

    getBody = () => {
        debugger;
        return (
            <tbody>

            { this.state.quotes.map( (quote) => {
                return <QuoteLine user={this.state.user} quote={quote} onDelete={this.quoteDelete} checked={this.state.checkboxes[quote.id]} onChange={ this.onCheckboxChange } />
            })}

            </tbody>
        )
    };

    perPageChange = (e) => {
        debugger;
        let href = this.removeURLParameter(window.location.href, 'rows');
        let rows = e.target.innerText;
        href = (href.indexOf("?")) > 0 ? href +'&rows=' + rows : href +'?rows=' + rows;
        window.location.href = href;
    };

    removeURLParameter = (url, parameter) => {
        //prefer to use l.search if you have a location/link object
        let urlparts = url.split('?');
        if (urlparts.length >= 2) {

            let prefix = encodeURIComponent(parameter) + '=';
            let pars = urlparts[1].split(/[&;]/g);

            //reverse iteration as may be destructive
            for (let i = pars.length; i-- > 0;) {
                //idiom for string.startsWith
                if (pars[i].lastIndexOf(prefix, 0) !== -1) {
                    pars.splice(i, 1);
                }
            }

            return urlparts[0] + (pars.length > 0 ? '?' + pars.join('&') : '');
        }
        return url;
    };

    getCommands = () => {

        let commands = [
            { 'name' : '10', 'callback': this.perPageChange },
            { 'name' : '25', 'callback': this.perPageChange },
            { 'name' : '50', 'callback': this.perPageChange },
            { 'name' : '100', 'callback': this.perPageChange },
            { 'name' : 'all', 'callback': this.perPageChange },
        ];

        return (

            <div className="dropdown mr-4">
                <button type="button" className="btn dropdown-toggle" data-toggle="dropdown">
                    Rows
                </button>
                <div className="dropdown-menu">
                    { commands.map( action => {
                        return <a className="dropdown-item" href="#" onClick={action.callback}>{ action.name.charAt(0).toUpperCase() + action.name.slice(1) }</a>;
                    })}
                </div>
            </div>

        );
    };


    getActions = () => {

        let actions = [
            { 'name' : 'delete', 'callback': this.onDelete },
        ];

        return (
            <div className="dropdown mr-4">
                <button type="button" className="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                    Actions
                </button>
                <div className="dropdown-menu">
                    { actions.map( action => {
                        return <a className="dropdown-item" href="#" onClick={action.callback}>{ action.name.charAt(0).toUpperCase() + action.name.slice(1) }</a>;
                    })}
                </div>
            </div>

        );
    };

    getPagination = () => {
        return this.props.use_pagination === 1 ? <Pagination pagination={pagination} /> : '';
    };

    getTable = () => {

        if (this.state.quotes.length)
            return (
                <div>

                    <div className="__fd3-table-responsive">
                        <table className="table table-striped table-bordered tablesorter">

                            { this.getHeader() }

                            { this.getBody() }

                        </table>
                    </div>

                    { this.getPagination() }

                </div>
            );
        else {
            return <div style={{padding: '10px 20px', textAlign:'center',fontSize:'1.1rem', 'color': '#2874a4', 'fontStyle': 'italics'}}>No quotes.</div>
        }
    };

    render() {

        return (

            <div>

                <div className="row">
                    <div className="col-md-12">
                        <h4 className="heading-info mb-4">Recent Quotes</h4>
                    </div>

                    <div className="col-md-3 mb-2">
                        { (!! this.state.quotes.length) && (this.state.user.type_id === 5) && this.getActions() }
                        {/*{ !! this.state.quotes.length && this.getCommands() }*/}
                    </div>

                    <div className="col-md-12">
                        { this.getTable() }
                    </div>

                </div>

            </div>
        );
    }
}

QuotesReportTable.propTypes = {
    user: PropTypes.object.isRequired,
    affiliate_id: PropTypes.number.isRequired,
    use_pagination: PropTypes.number.isRequired,
    quotes: PropTypes.array.isRequired,
    pagination: PropTypes.array.isRequired,
};

QuotesReportTable.defaultProps = {
    user: {},
    affiliate_id: 0,
    use_pagination: 0,
    quotes: [],
    pagination: []
};

export default QuotesReportTable;

if (document.getElementById('quotes-table')) {
    render(
        <QuotesReportTable user={user} quotes={quotes} affiliate_id={affiliate_id} pagination={pagination} use_pagination={1} />,
        document.getElementById('quotes-table')
    );
}
