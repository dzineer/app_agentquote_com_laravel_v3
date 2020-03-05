import React, { Component } from 'react';
import { render } from 'react-dom';
import PropTypes from 'prop-types';
import Request from '../../utils/FD3Request';
import message from '../../utils/FD3Messaging';
import Pagination from "./Pagination";
import CarrierLine from "./CarrierLine";

/** class TopCarriersReportTable */
class TopCarriersReportTable extends Component {

    constructor(props) {
        super(props);

        this.state = {
            user: this.props.user,
            affiliate_id: this.props.affiliate_id,
            carriers: this.props.carriers,
            pagination: this.props.pagination,
            checkboxes: []
        };

    }

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

    getHeader = () => {

        let columns = [
            { 'name' : 'carrier', 'sortable': true }
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

                                    <a href={ this.state.pagination.path + '?sortby' + column.name + '&page=' + this.state.pagination.current_page }
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

            { this.state.carriers.map( (carrier) => {
                return <CarrierLine user={this.state.user} carrier={carrier} />
            })}

            </tbody>
        )
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
            return <div style={{padding: '10px 20px', textAlign:'center',fontSize:'1.1rem', 'color': '#2874a4', 'fontStyle': 'italics'}}>No report.</div>
        }
    };

    render() {

        return (

            <div>

                <div className="row">

                    <div className="col-md-12">
                        { this.getTable() }
                    </div>

                </div>

            </div>
        );
    }
}

TopCarriersReportTable.propTypes = {
    user: PropTypes.object.isRequired,
    affiliate_id: PropTypes.number.isRequired,
    use_pagination: PropTypes.number.isRequired,
    carriers: PropTypes.array.isRequired,
    pagination: PropTypes.array.isRequired,
};

TopCarriersReportTable.defaultProps = {
    user: {},
    affiliate_id: 0,
    use_pagination: 0,
    carriers: [],
    pagination: []
};

export default TopCarriersReportTable;

if (document.getElementById('top-carriers-table')) {
    render(
        <TopCarriersReportTable user={user} carriers={carriers} affiliate_id={affiliate_id} pagination={pagination} use_pagination={1} />,
        document.getElementById('top-carriers-table')
    );
}
