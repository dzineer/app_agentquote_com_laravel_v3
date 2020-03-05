import React, {Component} from 'react';
import PropTypes from 'prop-types';

/** class STableHead */
class STableHead extends Component {
    constructor(props) {
        super(props);
        this.state = {
            name: this.props.name,
            className: this.props.className,
            style: this.props.style,
            callback: this.props.callback,
            sortable: this.props.sortable,
            checkbox: this.props.checkbox,
            page: this.props.page,
            path: this.props.path,
            onCheckAllChange: this.props.onCheckAllChange,
        };
    }

    getPath = (direction) => {
        if (direction === 'asc') {
            return this.state.path + '?sortby=' + this.state.name + '&order=asc' + '&page=' + this.state.page
        }
        else if (direction === 'desc') {
            return this.state.path + '?sortby=' + this.state.name + '&order=desc' + '&page=' + this.state.page
        }
    };

    getColumnName = () => {
        return this.state.name.charAt(0).toUpperCase() + this.state.name.slice(1)
    };

    renderColumn = () => {

        let styles = {
            checkbox: {
                textAlign: 'center'
            }
        };

        if (this.state.sortable) {
            return (
                <th className={"sheader"}>{ this.getColumnName() }
                    <a href={ this.getPath('asc') }
                       className="ascending" title="Ascending" />

                    <a href={ this.getPath('desc') }
                       className="descending" title="Descending" />
                </th>
            );
        }
        else if (this.state.checkbox) {
                return (
                    <th style={styles.checkbox} >
                        <input type="checkbox" className="" name="check-all" value={ true } onChange={this.onCheckAllChange} />
                    </th>
                );
        }
        else {
            return (
                <th className={"sheader"}>{ this.getColumnName() }
                </th>
            );
        }
    };

    render() {
        return this.renderColumn();
    }
}

STableHead.propTypes = {
    name: PropTypes.object.isRequired,
    className: PropTypes.string,
    style: PropTypes.object,
    callback: PropTypes.func.isRequired,
    sortable: PropTypes.bool.isRequired,
    checkbox: PropTypes.bool,
    page: PropTypes.number,
    path: PropTypes.string,
    onCheckAllChange: PropTypes.func
};

STableHead.defaultProps = {
    column: [],
    className: '',
    style: {},
    callback: () => {},
    checkbox: false,
    sortable: false,
    page: 0,
    path: '',
    onCheckAllChange: () => {}
};

export default STableHead;