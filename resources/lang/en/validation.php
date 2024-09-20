<?php
return [
    "accepted" => " :attribute باید پذیرفته شود.",
    "active_url" => " :attribute یک URL معتبر نیست.",
    "after" => " :attribute باید تاریخ بعد از :dateباشد.",
    "after_or_equal" => " :attribute باید تاریخ بعد یا برابر با :dateباشد.",
    "alpha" => " :attribute ممکن است فقط شامل حروف باشد.",
    "alpha_dash" => " :attribute ممکن است فقط شامل حروف، اعداد، خط تیره و زیرخط باشد.",
    "alpha_num" => " :attribute ممکن است فقط شامل حروف و اعداد باشد.",
    "array" => " :attribute باید یک آرایه باشد.",
    "before" => "تاریخ :attribute باید قبل از :dateباشد.",
    "before_or_equal" => " :attribute باید تاریخ قبل یا برابر با :dateباشد.",
    "between" => [
        "array" => " :attribute باید بین :min تا :max مورد داشته باشد.",
        "file" => " :attribute باید بین :min تا :max کیلوبایت باشد.",
        "numeric" => " :attribute باید بین :min و :maxباشد.",
        "string" => " :attribute باید بین :min و :max کاراکتر باشد."
    ],
    "boolean" => "فیلد :attribute باید درست یا نادرست باشد.",
    "confirmed" => "تأییدیه :attribute مطابقت ندارد.",
    "custom" => ["attribute-name" => ["rule-name" => "پیام سفارشی"]],
    "date" => " :attribute تاریخ معتبری نیست.",
    "date_format" => " :attribute با قالب :formatمطابقت ندارد.",
    "different" => " :attribute و :other باید متفاوت باشند.",
    "digits" => " :attribute باید :digits رقم باشد.",
    "digits_between" => " :attribute باید بین :min و :max رقم باشد.",
    "dimensions" => "ابعاد تصویر :attribute نامعتبر است.",
    "distinct" => "فیلد :attribute دارای یک مقدار تکراری است.",
    "email" => " :attribute باید یک آدرس ایمیل معتبر باشد.",
    "exists" => " :attribute انتخاب شده نامعتبر است.",
    "file" => " :attribute باید یک فایل باشد.",
    "filled" => "فیلد :attribute باید دارای یک مقدار باشد.",
    "gt" => [
        "array" => " :attribute باید بیش از :value مورد داشته باشد.",
        "file" => " :attribute باید بیشتر از :value کیلوبایت باشد.",
        "numeric" => " :attribute باید بزرگتر از :valueباشد.",
        "string" => " :attribute باید بیشتر از :value کاراکتر باشد."
    ],
    "gte" => [
        "array" => " :attribute باید :value مورد یا بیشتر داشته باشد.",
        "file" => " :attribute باید بزرگتر یا مساوی :value کیلوبایت باشد.",
        "numeric" => " :attribute باید بزرگتر یا مساوی :valueباشد.",
        "string" => " :attribute باید بزرگتر یا مساوی :value کاراکتر باشد."
    ],
    "image" => " :attribute باید یک تصویر باشد.",
    "in" => " :attribute انتخاب شده نامعتبر است.",
    "in_array" => "فیلد :attribute در :otherوجود ندارد.",
    "integer" => " :attribute باید یک عدد صحیح باشد.",
    "ip" => " :attribute باید یک آدرس IP معتبر باشد.",
    "ipv4" => " :attribute باید یک آدرس IPv4 معتبر باشد.",
    "ipv6" => " :attribute باید یک آدرس IPv6 معتبر باشد.",
    "json" => " :attribute باید یک رشته JSON معتبر باشد.",
    "lt" => [
        "array" => " :attribute باید کمتر از :value مورد داشته باشد.",
        "file" => " :attribute باید کمتر از :value کیلوبایت باشد.",
        "numeric" => " :attribute باید کمتر از :valueباشد.",
        "string" => " :attribute باید کمتر از :value کاراکتر باشد."
    ],
    "lte" => [
        "array" => " :attribute نباید بیش از :value مورد داشته باشد.",
        "file" => " :attribute باید کمتر یا مساوی :value کیلوبایت باشد.",
        "numeric" => " :attribute باید کمتر یا مساوی :valueباشد.",
        "string" => " :attribute باید کمتر یا برابر با :value کاراکتر باشد."
    ],
    "max" => [
        "array" => " :attribute ممکن است بیش از :max مورد نداشته باشد.",
        "file" => " :attribute ممکن است بیشتر از :max کیلوبایت نباشد.",
        "numeric" => " :attribute ممکن است بزرگتر از :maxنباشد.",
        "string" => " :attribute ممکن است بیشتر از :max کاراکتر نباشد."
    ],
    "mimes" => " :attribute باید فایلی از نوع: :valuesباشد.",
    "mimetypes" => " :attribute باید فایلی از نوع: :valuesباشد.",
    "min" => [
        "array" => " :attribute باید حداقل :min مورد داشته باشد.",
        "file" => " :attribute باید حداقل :min کیلوبایت باشد.",
        "numeric" => " :attribute باید حداقل :minباشد.",
        "string" => " :attribute باید حداقل :min کاراکتر باشد."
    ],
    "not_in" => " :attribute انتخاب شده نامعتبر است.",
    "not_regex" => "قالب :attribute نامعتبر است.",
    "numeric" => " :attribute باید یک عدد باشد.",
    "present" => "فیلد :attribute باید وجود داشته باشد.",
    "regex" => "قالب :attribute نامعتبر است.",
    "required" => "فیلد :attribute الزامی است.",
    "required_if" => "وقتی :other  :valueباشد، فیلد :attribute لازم است.",
    "required_unless" => "فیلد :attribute مورد نیاز است مگر اینکه :other در :valuesباشد.",
    "required_with" => "وقتی :values وجود دارد، فیلد :attribute لازم است.",
    "required_with_all" => "وقتی :values وجود دارد، فیلد :attribute لازم است.",
    "required_without" => "وقتی :values وجود ندارد، فیلد :attribute لازم است.",
    "required_without_all" => "وقتی هیچ یک از :values وجود ندارد، فیلد :attribute ضروری است.",
    "same" => " :attribute و :other باید مطابقت داشته باشند.",
    "size" => [
        "array" => " :attribute باید حاوی :size مورد باشد.",
        "file" => " :attribute باید :size کیلوبایت باشد.",
        "numeric" => " :attribute باید :sizeباشد.",
        "string" => " :attribute باید :size کاراکتر باشد."
    ],
    "string" => " :attribute باید یک رشته باشد.",
    "timezone" => " :attribute باید یک منطقه معتبر باشد.",
    "unique" => " :attribute قبلاً گرفته شده است.",
    "uploaded" => " :attribute بارگذاری نشد.",
    "url" => "قالب :attribute نامعتبر است."
];
