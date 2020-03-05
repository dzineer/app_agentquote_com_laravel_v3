import React from 'react';
import PropTypes from 'prop-types';
import CarrierProducts from './CarrierProducts';
import CheckBoxInput from "../CheckBoxInput/CheckBoxInput";

/** function: Carriers */
const Carriers = ({carriers, parent, onChange, indeterminate}) => {
    const css = {
        for: {
            carriers: {
                marginLeft: '20px'
            }
        }
    };

    const onCarrierChange = (type, name, value, parent, el) => {
        return onChange(type, name, value, parent, el);
    };

    return (
        <div style={css.for.carriers}>
            { carriers.map( carrier => {
                return (
                    <div key={ carrier.name }>
                        <CheckBoxInput
                            name={ carrier.name }
                            label={ carrier.label }
                            indeterminate={ indeterminate }
                            onChange={ onCarrierChange.bind(this, "carrier", carrier.name, carrier.name, parent) }
                        />

                        <CarrierProducts products={ carrier.products } onChange={onChange} parent={parent+","+carrier.name} />
                    </div>
                )

            })}
        </div>
    );
}

Carriers.propTypes = {
    carriers: PropTypes.array.isRequired,
    parent: PropTypes.string.isRequired,
    onChange: PropTypes.func.isRequired,
    indeterminate: PropTypes.bool
};

Carriers.defaultProps = {
    //myProp: val
    indeterminate: false,
    carriers: []
};

export default Carriers;