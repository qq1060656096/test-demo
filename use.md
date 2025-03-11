### tools3 工具安装

```text
1. 安装 tools3
2. 创建 jc 文件用于生成测试方法参数集合【示例 demo_config.json】
3. 安装php
4. 要测试的php文件【php业务代码文件】
5. 生成phpunit测试文件
6. 安装allure
7. pc-dhb168项目运行phpunit
8. 查看allure测试报告
```

## 1. 安装 tools3
```shell
python3 -m venv myenv
source myenv/bin/activate
pip install tools3==0.1.1 
pip install tools3==0.1.1 --index-url https://pypi.org/simple

```

## 2. 创建 jc 文件用于生成测试方法参数集合【示例 demo_config.json】

> vi tests/Tools3Tests/Dinghuobao/Common/Modules/Infrastructure/Helper/date_helper.json
```json
{
  "params": {
    "dateStr": {
      "values": {
        "日期_零": "0000-00-00 00:00:00",
        "日期_有": "2025-03-11 00:00:01",
        "日期_无": "2025-03-11"
      }
    },
    "format": {
      "values": {
        "年月日时分秒": "Y-m-d H:i:s"
      }
    }
  },
  "expected": true
}
```


## 3. 安装php
> 如果已经安装好php，请跳过此步骤
```shell
# ubuntu
sudo apt install software-properties-common -y
sudo add-apt-repository ppa:ondrej/php -y
sudo apt update
sudo apt install php7.3 -y
```

## 4. 要测试的php文件【php业务代码文件】
```shell
vi Dinghuobao/Common/Modules/Infrastructure/Helper/Helper.php
```
```php
<?php
/**
 * Created by PhpStorm.
 * User: zhaoweijie
 * Date: 2019-10-23
 * Time: 18:01
 */

namespace Common\Modules\Infrastructure\Helper;


/**
 * Class Helper
 * @package Common\Modules\Infrastructure\Helper
 */
class Helper
{
    const IS_T = 'T';
    const IS_F = 'F';

    const ZERO_DATE_Ymd = '0000-00-00';
    // AI Generated Code
    // Author: zhao si gui
    const ZERO_DATE_YmdHis = '0000-00-00 00:00:00';
    const MIN_DEFAULT_DATE_Ymd = '1970-01-01';
    const MIN_DEFAULT_DATE_YmdHis = '1970-01-01 00:00:00';

    const DATE_SHOW_MAP = [
        self::ZERO_DATE_Ymd => '',
        self::ZERO_DATE_YmdHis => '',
        self::MIN_DEFAULT_DATE_Ymd => '',
        self::MIN_DEFAULT_DATE_YmdHis => '',
    ];

    const DATE_FORMAT_YmdHis = 'Y-m-d H:i:s';
    const DATE_FORMAT_YmdHi = 'Y-m-d H:i';
    const DATE_FORMAT_Ymd = 'Y-m-d';
    const DATE_FORMAT_Ym = 'Y-m';


    const DATE_FORMAT_YmdHisStart = 'Y-m-d 00:00:00';
    const DATE_FORMAT_YmdHisEnd = 'Y-m-d 23:59:59';

    const DATE_FORMAT_YmdHiStart = 'Y-m-d H:i:00';
    const DATE_FORMAT_YmdHiEnd = 'Y-m-d H:i:59';

    const FORMAT_SYS_NUMBER = 1;
    const FORMAT_SYS_PRICE = 2;
    const FORMAT_SYS_ORDER_PRICE = 3;
    const FORMAT_INT = 4;
    const FORMAT_FLOAT = 5;
    const FORMAT_STRING = 6;

    /**
     * @param string $date_1
     * @param string $date_2
     * @param string $differenceFormat
     * @return string
     * @throws \Exception
     */
	public static function dateDifference($date_1 , $date_2 , $differenceFormat = '%a' )
    {
        $datetime1 = date_create($date_1);
        $datetime2 = date_create($date_2);
        $interval = date_diff($datetime1, $datetime2);
        if (!$interval) {
            throw new \Exception("时间格式错误", 500100011);
        }
        return $interval->format($differenceFormat);
    }


    /**
     * 日期格式检测
     * @param string $dateStr
     * @param string $format 默认是 'Y-m-d H:i:s'
     * @return bool
     */
    public static function dateFormatCheck($dateStr, $format = 'Y-m-d H:i:s')
    {
        $dateStr = trim($dateStr);
        if (empty($dateStr)) {
            return false;
        }
        $time = strtotime($dateStr);
        if ($time <= 0) {
            return false;
        }
        $checkDateStr = date($format, $time);
        if (!$checkDateStr) {
            return false;
        }
        if ($checkDateStr != $dateStr) {
            return false;
        }
        return true;
    }

    /**
     * 日期检测
     * @param string $dateStr
     * @return bool
     */
    public static function dateFormatCheckSimple($dateStr)
    {
        if (!Helper::dateFormatCheck($dateStr, Helper::DATE_FORMAT_Ymd) && !Helper::dateFormatCheck($dateStr, Helper::DATE_FORMAT_YmdHi) && !Helper::dateFormatCheck($dateStr, Helper::DATE_FORMAT_YmdHis) && !Helper::dateFormatCheck($dateStr, Helper::DATE_FORMAT_Ym)) {
            return false;
        }
        return true;
    }

    /**
     * 自动检查日期格式， 成功返回日期格式，失败返回false
     *
     * @param string $date
     * @return false|string
     */
    public static function autoCheckDateFormat($date) {
        if (self::dateFormatCheck($date, self::DATE_FORMAT_Ymd)) {
            return self::DATE_FORMAT_Ymd;
        }
        if (self::dateFormatCheck($date, self::DATE_FORMAT_YmdHi)) {
            return self::DATE_FORMAT_YmdHi;
        }
        if (self::dateFormatCheck($date, self::DATE_FORMAT_YmdHis)) {
            return self::DATE_FORMAT_YmdHis;
        }
        if (self::dateFormatCheck($date, self::DATE_FORMAT_Ym)) {
            return self::DATE_FORMAT_Ym;
        }
        return false;
    }


}
```


## 5. 生成phpunit测试文件
```shell
# 会在 date_helper.json 文件目录生成 date_helper.phpunit文件
tools3-cli -t jc_phpunit tests/Tools3Tests/Dinghuobao/Common/Modules/Infrastructure/Helper/date_helper.json

# -o 生成phpunit到指定的文件 TestSetListOriginBrandInfo.php 
# 注意 -o 不会创建目录
# -php php路径【如果你不一样请修改】
# -uf 要测试的代码文件
# -um 要测试的代码方法
# -lt 模型类型 deepseek
# -lk api key
# 其他选项请看 tools3-cli -h
tools3-cli -t jc_phpunit -php=/usr/local/Cellar/php@7.3/7.3.33_11/bin/php -lt deepseek -lurl=https://api.deepseek.com -lk=sk-05e8317ce08641c684108e5012c560ec -lm=deepseek-chat -uf=Dinghuobao/Common/Modules/Infrastructure/Helper/Helper.php -um=dateFormatCheck -o tests/Tools3Tests/Dinghuobao/Common/Modules/Infrastructure/Helper/HelperDateFormatCheckTest.php tests/Tools3Tests/Dinghuobao/Common/Modules/Infrastructure/Helper/date_helper.json
```

## 6. 安装allure
```shell
# 安装allure
sudo apt install allure -y
```

## 7. 运行phpunit
```shell
/usr/local/Cellar/php@7.3/7.3.33_11/bin/php build/phpunit -c phpunit.allure.xml tests/Tools3Tests
```

## 8. 查看allure测试报告
```shell

allure serve tests/Tools3Tests/allure-results
```

### 安装报错
> pip install tools3=0.1.0.dev2 --index-url https://pypi.org/simple
```shell
INFO: pip is looking at multiple versions of langchain-community to determine which version is compatible with other requirements. This could take a while.
ERROR: Could not find a version that satisfies the requirement SQLAlchemy<3,>=1.4 (from langchain-community) (from versions: none)
ERROR: No matching distribution found for SQLAlchemy<3,>=1.4
```
> 解决办法
```shell
pip install --upgrade pip
```
> 解决办法2
```shell
pip install SQLAlchemy>=1.4,<3 --index-url https://pypi.org/simple
```