import React, {Component} from 'react';
import PropTypes from 'prop-types';

/** class STableRow */
class STableRow extends Component {

    constructor(props) {
        super(props);
        this.state = {
            data: this.props.data,
            checkbox: this.props.checkbox,
            checked: this.props.checked,
            onChange: this.props.onChange,
            onDelete: this.props.onDelete,
        };
        this.onChange.bind(this);
        this.onDelete.bind(this);
    }

    onDelete = (e) => {
        e.preventDefault();
        this.props.onDelete(this.state.quote);
    };

    onChange = (e) => {
        this.props.onChange(this.state.quote);
    };

    getIfCheckbox = () => {
        let styles = {
            checkbox: {
                textAlign: 'center'
            }
        };

        if (this.state.checkbox) {
            return (
                <td style={styles.checkbox} >
                    <input type="checkbox" className="" value={ this.state.quote.id } checked={ this.props.checked } onChange={this.onChange} />
                </td>
            );
        } else {
            return '';
        }
    };

    numberWithCommas = (x) => {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    };

    formatNum = (n) => {
        debugger;
        if (n === 0) {
            return ' ';
        }

        if ( n.indexOf(".") !== -1 ) {
            // found a string decimal

            let final_num = parseFloat(n).toFixed(2);
            final_num = numberWithCommas(final_num);

            return final_num;

            let pieces = n.split(".");
            let left = pieces[0];
            let right = pieces[1];
            right = right.toString();

            if (right.length > 2) {
                right = right.replace(/0/g, '');
            }

            debugger;
            while(right.length < 2) {
                right = right + "0";
            }
            return left + "." + right;
        }
    };

    buildNumber = (n) => {
        let n1 = n*1000;
        let n2 = this.numberWithCommas(n1);
        return n2;
    };

    buildRow = (column) => {
        let value = column.value;

        if (column.format && column.money) {
            value = this.buildNumber(value);
        }

        return (
            <td>
                <div>
                    <span className="font-medium link">{ value }</span>
                </div>
            </td>
        );
    };

    render() {

        return (

            <tr>

                { this.getIfCheckbox() }
                { this.state.data.map( this.buildRow )}

            </tr>
        );
    }
}

STableRow.propTypes = {
    /** myProp */
    data: PropTypes.array.isRequired,
    checkbox: PropTypes.object.isRequired,
    checked: PropTypes.bool.isRequired,
    onChange: PropTypes.func.isRequired,
    onDelete: PropTypes.func.isRequired,
};

STableRow.defaultProps = {
    data: [],
    checkbox: {},
    checked: false,
    onChange: () => {},
    onDelete: () => {},
};

export default STableRow;