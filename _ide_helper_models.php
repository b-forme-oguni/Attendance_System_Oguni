<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App{
/**
 * App\Admin
 *
 * @property int $id ID
 * @property string $name 名前
 * @property string $password パスワード
 * @property string|null $remember_token ログイン保持
 * @property \Illuminate\Support\Carbon|null $created_at 登録日時
 * @property \Illuminate\Support\Carbon|null $updated_at 更新日時
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Admin newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Admin newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Admin query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Admin whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Admin whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Admin whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Admin wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Admin whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Admin whereUpdatedAt($value)
 */
	class Admin extends \Eloquent {}
}

namespace App{
/**
 * App\Note
 *
 * @property int $id
 * @property string $note 備考
 * @property \Illuminate\Support\Carbon|null $created_at 登録日時
 * @property \Illuminate\Support\Carbon|null $updated_at 更新日時
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Note newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Note newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Note query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Note whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Note whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Note whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Note whereUpdatedAt($value)
 */
	class Note extends \Eloquent {}
}

namespace App{
/**
 * App\Performance
 *
 * @property int $id ID
 * @property string $insert_date 日付
 * @property string $start 開始時間
 * @property string|null $end 終了時間
 * @property int $user_id 利用者ID
 * @property int $food_fg 食事提供加算フラグ
 * @property int $outside_fg 施設外支援フラグ
 * @property int $medical_fg 医療連携体制加算フラグ
 * @property int|null $note_id 備考
 * @property \Illuminate\Support\Carbon|null $created_at 登録日時
 * @property \Illuminate\Support\Carbon|null $updated_at 更新日時
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Performance newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Performance newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Performance query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Performance whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Performance whereEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Performance whereFoodFg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Performance whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Performance whereInsertDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Performance whereMedicalFg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Performance whereNoteId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Performance whereOutsideFg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Performance whereStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Performance whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Performance whereUserId($value)
 */
	class Performance extends \Eloquent {}
}

namespace App{
/**
 * App\School
 *
 * @property int $id
 * @property string $school_name 学校名
 * @property \Illuminate\Support\Carbon|null $created_at 登録日時
 * @property \Illuminate\Support\Carbon|null $updated_at 更新日時
 * @method static \Illuminate\Database\Eloquent\Builder|\App\School idEqual($int)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\School newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\School newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\School query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\School whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\School whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\School whereSchoolName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\School whereUpdatedAt($value)
 */
	class School extends \Eloquent {}
}

namespace App{
/**
 * App\User
 *
 * @property int $id ID
 * @property string $last_name 姓
 * @property string $first_name 名
 * @property string $last_name_kana セイ
 * @property string $first_name_kana メイ
 * @property int $school_id 所属ID
 * @property string|null $deleted_at 削除フラグ
 * @property \Illuminate\Support\Carbon|null $created_at 登録日時
 * @property \Illuminate\Support\Carbon|null $updated_at 更新日時
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User schoolIdEqual($int)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereFirstNameKana($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereLastNameKana($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereSchoolId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

namespace App{
/**
 * App\User_bk
 *
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User_bk newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User_bk newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User_bk query()
 */
	class User_bk extends \Eloquent {}
}

