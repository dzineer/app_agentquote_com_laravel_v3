"use strict";
var __extends = (this && this.__extends) || (function () {
    var extendStatics = function (d, b) {
        extendStatics = Object.setPrototypeOf ||
            ({ __proto__: [] } instanceof Array && function (d, b) { d.__proto__ = b; }) ||
            function (d, b) { for (var p in b) if (b.hasOwnProperty(p)) d[p] = b[p]; };
        return extendStatics(d, b);
    }
    return function (d, b) {
        extendStatics(d, b);
        function __() { this.constructor = d; }
        d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
    };
})();
Object.defineProperty(exports, "__esModule", { value: true });
var react_1 = require("react");
var prop_types_1 = require("prop-types");
/** function: ContactMeModal */
var ContactMeModal = /** @class */ (function (_super) {
    __extends(ContactMeModal, _super);
    function ContactMeModal(props) {
        var _this = _super.call(this, props) || this;
        _this.onChange = function (event) {
            var _a;
            var newState = Object.assign({}, _this.state.contact, (_a = {}, _a[event.target.net] = event.target.value, _a));
            _this.setState({
                contact: newState
            });
        };
        _this.onSubmit = function (event) {
            event.preventDefault();
            console.log(_this.state.contact);
        };
        _this.modal_body = className = "modal-body" >
            { form_fields: form_fields }
            < /form>
            < /div>;
        _this.modal_footer = className = "modal-footer" >
            type;
        _this.className = "btn btn-secondary";
        _this.state = {
            contact: {
                recipient_name: '',
                recipient_phone: '',
                recipient_email: '',
                recipient_message: ''
            }
        };
        return _this;
    }
    ContactMeModal.prototype.render = function () {
        var _a = this.props, label = _a.label, from = _a.from, email = _a.email;
        var styles = {
            for: {
                label: {
                    textAlign: 'left',
                    width: '100%'
                },
                modalTitle: {
                    width: '100%'
                }
            }
        };
        var modal_header = className = "modal-header" >
            className;
        "modal-title text-center";
        id = "";
        style = { styles: .for.modalTitle } > Please;
        be;
        sure;
        to;
        fill;
        out;
        the;
        fields;
        below: /h5>
            < button;
        type = "button";
        className = "close";
        data - dismiss;
        "ContactMeModal";
        aria - label;
        "Close" >
            aria - hidden;
        "true" >  & times;
        /span>
            < /button>
            < /div>;
        ;
        var fields = [
            { name: 'recipient_name', label: 'Name', type: 'single' },
            { name: 'recipient_phone', label: 'Phone', type: 'single' },
            { name: 'recipient_email', label: 'Email', type: 'single' },
            { name: 'recipient_message', label: 'Message', type: 'block', rows: 5 }
        ];
        var form_fields = fields.map(function (field) {
            return field.type === 'single' ?
                key : ;
            {
                Math.floor(Math.random() * 20);
            }
            name = { name: name };
            label = { field: .label };
            required = { false:  };
            styles = { styles: .for.label };
            onChange = { this: .onChange }
                /  >
            ;
        });
        className;
        "form-group";
        key = { Math: .floor(Math.random() * 20) } >
            htmlFor;
        "message-text";
        className = "col-form-label";
        style = { styles: .for.label } > { field: .label } < /label>
            < textarea;
        className = "form-control";
        id = { name: name };
        name = { name: name };
        rows = { field: .rows } /  >
            /div>;
    };
    ;
    ;
    return ContactMeModal;
}(react_1.Component));
-dismiss;
"ContactMeModal" > Close < /button>
    < button;
type = "button";
className = "btn btn-primary" > Send;
message < /button>
    < /div>;
;
var modal_window = href = "#", className = "btn btn-primary btn-lg", data;
-toggle;
"ContactMeModal";
data - target;
"#ContactMeModal";
data - whatever;
"@mdo" > { label: label } < /a>
    < div;
className = "modal fade";
id = "ContactMeModal";
tabIndex = "-1";
role = "dialog";
aria - labelledby;
"exampleContactMeModalLabel";
aria - hidden;
"true" >
    className;
"modal-dialog modal-lg";
role = "document" >
    className;
"modal-content" >
    { modal_header: modal_header };
{
    modal_body;
}
{
    modal_footer;
}
/div>
    < /div>
    < /div>
    < /div>;
;
return ({ modal_window: modal_window }
    < /div>);
ContactMeModal.propTypes = {
    label: prop_types_1.default.string,
    from: prop_types_1.default.string,
    email: prop_types_1.default.string
};
ContactMeModal.defaultProps = {
//myProp: val
};
exports.default = ContactMeModal;
