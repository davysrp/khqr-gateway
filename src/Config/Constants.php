<?php

declare(strict_types=1);

namespace KHQR\Config;

class Constants
{
    const BAKONG_API_BASE_URL = 'https://api-bakong.nbc.gov.kh'; // For production

    const BAKONG_API_SIT_BASE_URL = 'https://sit-api-bakong.nbc.gov.kh'; // For testing

    const ACCOUNT_URL = self::BAKONG_API_BASE_URL.'/v1/check_bakong_account';

    const RENEW_TOKEN_URL = self::BAKONG_API_BASE_URL.'/v1/renew_token';

    const DEEPLINK_URL = self::BAKONG_API_BASE_URL.'/v1/generate_deeplink_by_qr';

    const CHECK_TRANSACTION_MD5_URL = self::BAKONG_API_BASE_URL.'/v1/check_transaction_by_md5';

    const CHECK_TRANSACTION_MD5_LIST_URL = self::BAKONG_API_BASE_URL.'/v1/check_transaction_by_md5_list';

    const CHECK_TRANSACTION_FULL_HASH_URL = self::BAKONG_API_BASE_URL.'/v1/check_transaction_by_hash';

    const CHECK_TRANSACTION_FULL_HASH_LIST_URL = self::BAKONG_API_BASE_URL.'/v1/check_transaction_by_hash_list';

    const CHECK_TRANSACTION_SHORT_HASH_URL = self::BAKONG_API_BASE_URL.'/v1/check_transaction_by_short_hash';

    const CHECK_TRANSACTION_INSTRUCTION_REF_URL = self::BAKONG_API_BASE_URL.'/v1/check_transaction_by_instruction_ref';

    const CHECK_TRANSACTION_EXTERNAL_REF_URL = self::BAKONG_API_BASE_URL.'/v1/check_transaction_by_external_ref';

    const SIT_ACCOUNT_URL = self::BAKONG_API_SIT_BASE_URL.'/v1/check_bakong_account';

    const SIT_RENEW_TOKEN_URL = self::BAKONG_API_SIT_BASE_URL.'/v1/renew_token';

    const SIT_DEEPLINK_URL = self::BAKONG_API_SIT_BASE_URL.'/v1/generate_deeplink_by_qr';

    const SIT_CHECK_TRANSACTION_MD5_URL = self::BAKONG_API_SIT_BASE_URL.'/v1/check_transaction_by_md5';

    const SIT_CHECK_TRANSACTION_MD5_LIST_URL = self::BAKONG_API_SIT_BASE_URL.'/v1/check_transaction_by_md5_list';

    const SIT_CHECK_TRANSACTION_FULL_HASH_URL = self::BAKONG_API_SIT_BASE_URL.'/v1/check_transaction_by_hash';

    const SIT_CHECK_TRANSACTION_FULL_HASH_LIST_URL = self::BAKONG_API_SIT_BASE_URL.'/v1/check_transaction_by_hash_list';

    const SIT_CHECK_TRANSACTION_SHORT_HASH_URL = self::BAKONG_API_SIT_BASE_URL.'/v1/check_transaction_by_short_hash';

    const SIT_CHECK_TRANSACTION_INSTRUCTION_REF_URL = self::BAKONG_API_SIT_BASE_URL.'/v1/check_transaction_by_instruction_ref';

    const SIT_CHECK_TRANSACTION_EXTERNAL_REF_URL = self::BAKONG_API_SIT_BASE_URL.'/v1/check_transaction_by_external_ref';
}
