import React, {Component} from 'react';
import PropTypes from 'prop-types';
import STableHead from "./STableHead";

/** class STable */
class STable extends Component {
    constructor(props) {
        super(props);
        this.state = {
            columns: this.props.columns,
            data: this.props.data,
            pagination: this.pagination
        };
    }

    renderColumn = ( column ) => {

        return <STableHead
            name={column.name}
            path={this.state.pagination.path}
            page={this.state.pagination.current_page}
            sortable={column.sortable}
            checkbox={this.state.user.type_id === 5}
            callback={this.onCheckAllChange}
        />;
/*
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
        }*/
    };

    renderColumns = () => {
        let columns = [
            { 'name' : '',      'sortable': false },
            { 'name' : 'age',      'sortable': true },
            { 'name' : 'state',    'sortable': true },
            { 'name' : 'date',     'sortable': false },
            { 'name' : 'gender',   'sortable': true },
            { 'name' : 'term',     'sortable': true },
            { 'name' : 'benefit',  'sortable': true },
            { 'name' : 'category', 'sortable': true },
        ];

        return (
            <thead>
            <tr>
                { this.state.columns.map( this.renderColumn ) }
            </tr>
            </thead>
        );
    };

    renderData = () => {

    };

    renderHeader = () => {
        return this.renderColumns();
    };

    renderBody = () => {
        return this.renderData();
    };

    renderTable = () => {
        return (
            <div className="_fd3-table-responsive">
                <table className="table table-striped table-bordered tablesorter">
                    <thead>
                        { this.renderHeader() }
                    </thead>
                    <tbody>
                        { this.renderBody() }
                    </tbody>
                </table>
            </div>
        )
    };


    render() {
        return (
            <div>
                { this.renderTable() }
            </div>
        );
    }
}

STable.propTypes = {
    columns: PropTypes.array.isRequired,
    data: PropTypes.array.isRequired,
    pagination: PropTypes.object
};

STable.defaultProps = {
    columns: [],
    data: [],
    pagination: {}
};

export default STable;