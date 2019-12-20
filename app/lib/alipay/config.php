<?php
$config = array (	
		//应用ID,您的APPID。
		'app_id' => "2016101600702306",

		//商户私钥，您的原始格式RSA私钥
		'merchant_private_key' => "MIIEowIBAAKCAQEAxm7EUr+mlkY+McmP7QVbjXdAjwg2MzZ6bauVHFzYSXd/6NN+ulHYoTrJRB1dSk6oPiuNPfVrjyFK4DprzTqjOuptx8cUKF3VaoZiIrZO6XX+iI+BXjl6yKARU4BttwS56admlM5236dmK0ZfmfLuOYUoEAKVJ2gEUTyWcb9AYOM9k9XEc4T338ij36csIsFrQWr3BjxA41usnH2g6f+b3/qT25f8AIMrO8J8M8B22ULpsk0u7eVLrQMTnfJS1wU3l5bQkKMCinRfRaRZnepWFTQ5O3Axll//zW9TELsk6UiUIXWoZpr9czlhsydprF6DMuoJDcCQ5emgIqoQUhZSnwIDAQABAoIBAEKzBuC9tPQ8RjmcA/nq3BxQIm4xl25deIeWrjdrafQ/68nKFYXxbvy68t4ndK0+hUTohMB31yC0UyPN32CLvkRWenI1k6wB5nO5GhGK8Dl/RQCIJDcU4RXA4DIOMFLdjtRgRZXtVH3XGfuf2xC3XKYPASlohNRLHXBlCjjPzYcDI3GSSqxu/lZ0j785VK0lkFBgv7UOZxCearhij9S2odw2cXgQVlYPU9HRmg7qMtexl0TT030wU9yj1OJxh63rxmXMlb+UQDpWKP1L7ykF1uNRvaztzIaecPKdTMh4LovV56qPTH4Am6Ky9r4s60DfcEo7jMMsz4lzK/ByUIUhE1ECgYEA7rEgz+t5MWHRITu8ro9DvkZ5nphl/2f5ylc2beNXkffkUfKJAJmm+a73f0KQSbPJPgRJZY1CSOo+x5cYOwkOETpJTBpN+uIDiBGBviKJf+1LZRcqgjx3ek3TfOFkKPSESWjbzifCCquPlGCI+RRPabkFA5yIgd3TV5XdXszA/VkCgYEA1NJND2oCbE66fGEJNMPGCNteHg8N7kliDeL+5ALlvWJBZgLWFKxGy3gRVOhOhY+AKs8iN+2mDg6NGkApf4dcv7t63jWsM50SJgkXew9KeoucWcOpM8qZEsxQ/hUocRWdPUUobjZ3rzYsJnFiPOH76UmZcxz+noZ1KipX2B7r+LcCgYA+idQyBd0sDhfwICmwhsLWELr+zakzwPdWh4EwS3d/PDbrLaOtr5RrKOeZxUPuu5dHk3HzlI5Acndebf0gQqAX7XCU6vNxf1Qzi3q16XCjPvYZF3fAxbz8I3X860UF4gLjBQFKQ2p4xziIRL6+nA6ugZaJurKdbBRah16H3xfViQKBgQDUuwYmQzv60VNdYo2WPZ8lWUmh2EB/kMC/ysgoWLEWdjGS64DclzwIxJLmgXOD0+Y0ZGn658UVxfvLYplYjZDrYla16Yag7P+oH2xmKOm0xvrZS1hFmd0ayjqnT7TmHMnY5dk9GZrW+9pz7uBYpTdugJAvXasyAIr7Q+oc8QPEzwKBgCIagGl4oiftxsR043CbIfQsFyBQfINzXg618Vw8TiSDcGsbpdcGvDETEUWBg63Claw3fn7hc1Fy3UWF/xl72fLXhw7NRz7GUZ9LF57HrSgPy1ZtVFQrVCaQET03NC14GB1iC7XGFHmapT66naco+kMqoqD/Qj6kMiGP5a2HdtlU",
		
		//异步通知地址
		'notify_url' => "http://外网可访问网关地址/alipay.trade.page.pay-PHP-UTF-8/notify_url.php",
		
		//同步跳转
		'return_url' => "http://localhost/aliyun/return_url.php",

		//编码格式
		'charset' => "UTF-8",

		//签名方式
		'sign_type'=>"RSA2",

		//支付宝网关
		'gatewayUrl' => "https://openapi.alipaydev.com/gateway.do",

		//支付宝公钥,查看地址：https://openhome.alipay.com/platform/keyManage.htm 对应APPID下的支付宝公钥。
		'alipay_public_key' => "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAiVQjcK0C47Ag1fySoB0V9mN9zsPaCHxj/9j6C8ioM3/mv/tdJMuYLydxTFZxI6RXp9DF0V5PXWypBw1DRTJbhqgxf02cGQJDuXkmcfVYlzrphITXM9r8I+6JdzBn6shnxh8bBvYkrQY36XSXKltDEyrTdqKTjQ9REA5VrErmldMULH1XV/+XkJg+B1N+pNmHBROVP8QS8pL3i9VbjDaJveg/FEeyjZLw46XUIn9yRibOgD2fQbdQqRRf5WeVd6qc0fXxMZRoD8WoqYmBCiv1HIo2/hSKKojP6Q9t35lwX4UxA3ZYP2sHPb4shzS1ri700eLow1jpF424chdFsN15UQIDAQAB",

		
	
);