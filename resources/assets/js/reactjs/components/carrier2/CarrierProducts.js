import React from 'react';
import PropTypes from 'prop-types';
import CheckBoxInput from "../CheckBoxInput/CheckBoxInput";

/** function: CarrierProducts */
const CarrierProducts = ({products, parent, onChange}) => {
    const css = {
        for: {
            products: {
                marginLeft: '20px'
            }
        }
    };

    const onProductChange = (type, name, value, parent, el) => {
        return onChange(type, name, value, parent, el);
    };

    return (
        <div style={css.for.products}>
            { products.map( product => {
                return (
                    <CheckBoxInput
                        key={ product.name }
                        name={ product.name }
                        label={ product.label }
                        onChange={ onProductChange.bind(this, "product", product.name, product.name, parent ) }
                    />
                )
            })}
        </div>
    );
};

CarrierProducts.propTypes = {
    products: PropTypes.array.isRequired,
    parent: PropTypes.string.isRequired,
    onChange: PropTypes.func.isRequired
};

CarrierProducts.defaultProps = {
    //myProp: val
};

export default CarrierProducts;