// Đối tượng `Validator`
function Validator(options) {

    function validate(inputElement, rule) {
        var errorElement = inputElement.parentElement.querySelector(options.errorSelector);
        // console.log('onblur'+ rule.selector);
        // console.log(rule);
        // console.log(inputElement.value);
        var errorMessage = rule.test(inputElement.value); //đỗ dữ liệu nhập vào hàm test
        // console.log(errorMessage);
        if (errorMessage) {
            errorElement.innerText = errorMessage;
            inputElement.parentElement.classList.add('invalid');
        } else {
            errorElement.innerText = '';
            inputElement.parentElement.classList.remove('invalid');
        }
        // console.log(inputElement.parentElement.querySelector(options.errorSelector)); //get đến class thông báo
        return !errorMessage;
    }


    // Hàm thực hiện validate
    var formElement = document.querySelector(options.form);
    // console.log(formElement);

    if (formElement) {

        // Xử lý hành vi khi nhấn button
        formElement.onsubmit = function (e) {
            // e.preventDefault();
            console.log(formElement);
            var isFormValid = true;

            // Lặp qua từng rules và validate
            options.rules.forEach(function (rule) {
                // console.log(rule);
                var inputElement = formElement.querySelector(rule.selector);

                // console.log(inputElement);
                var isValid = validate(inputElement, rule);
                if(!isValid){
                    isFormValid = false;
                }

                if(isFormValid){
                    formElement.submit();
                }else{
                    document.querySelector("button").disabled = true;
                    setTimeout("window.location=\'login.php\'",3000);
                }

            });
        }


        options.rules.forEach(function (rule) {
            // console.log(rule);
            var inputElement = formElement.querySelector(rule.selector);

            // console.log(inputElement);
            if (inputElement) {
                inputElement.onblur = function () {
                    validate(inputElement, rule);
                }
            }

            // Xử lý mỗi khi người dùng nhập vào input
            inputElement.oninput = function () {
                var errorElement = inputElement.parentElement.querySelector(options.errorSelector);
                errorElement.innerText = '';
                inputElement.parentElement.classList.remove('invalid');
            }

        });
    }
}








// Định nghĩa rules
// Nguyên tắc của các rules:
// 1. Khi có lỗi => Trả ra message lỗi
// 2. Khi hợp lệ => Không trả ra cái gì cả (undefined)
Validator.isRequired = function (selector, message) {
    return {
        selector: selector,
        test: function (value) {
            return value ? undefined : 'Vui lòng nhập trường này';
        }
    };
}

Validator.isEmail = function (selector, message) {
    return {
        selector: selector,
        test: function (value) {
            var regex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
            return regex.test(value) ? undefined : 'Vui lòng nhập trường này'
        }
    };
}

Validator.minLength = function (selector, min, message) {
    return {
        selector: selector,
        test: function (value) {
            return value.length >= min ? undefined : `Vui lòng nhập tối thiểu ${min} kí tự`;
        }
    };
}

Validator.isConfirmed = function (selector, getConfirmValue, message) {
    return {
        selector: selector,
        test: function (value) {
            return value === getConfirmValue() ? undefined : 'Giá trị nhập vào không chính xác';
        }
    }
}

Validator.isNumber = function (selector, message) {
    return {
        selector: selector,
        test: function (value) {
            var itnhat1so = /\d/;
            return itnhat1so.test(value) ? undefined : 'Mật khẩu phải chứa ít 1 nhất số';
        }
    };
}

Validator.kytudacbiet = function (selector, message) {
    return {
        selector: selector,
        test: function (value) {
            var kytudacbiet = /[^a-zA-Z\d]/;
            return kytudacbiet.test(value) ? undefined : 'Mật khẩu phải chứa ít nhất 1 ký tự đặc biệt';
        }
    };
}