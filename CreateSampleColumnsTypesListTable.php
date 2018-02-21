<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Laravel Schema Builder
 * Column Types List
 * Column Qualifier List
 * Index Qualifier List
 * version 5.6/5.5
 */
class CreateSampleColumnsTypesListTable extends Migration
{
    public function up()
    {
        Schema::create('sample_column_types', function (Blueprint $table) {

          /* ---------------------------------------------------------------------------- *
           * Column Types List （カラムタイプ 一覧）
           * ---------------------------------------------------------------------------- */

          /**
           * AUTO_INCREMENT（自動増分ID）/UNSIGNED（符号なし）
           */
          $table->tinyIncrements('id');   // TINYINT
          $table->smallIncrements('id');  // SMALLINT
          $table->increments('id');       // INT
          $table->mediumIncrements('id'); // MEDIUMINT
          $table->bigIncrements('id');    // BIGINT

          /**
           * Numeric type（数値型）
           */
          $table->tinyInteger('votes');   // TINYINT
          $table->smallInteger('votes');  // SMALLINT
          $table->integer('votes');       // INTEGER
          $table->mediumInteger('votes'); // MEDIUMINT
          $table->bigInteger('votes');    // BIGINT

          /**
           * Numeric type（数値型）/UNSIGNED（符号なし）
           */
          $table->unsignedTinyInteger('votes');   // TINYINT
          $table->unsignedSmallInteger('votes');  // SMALLINT
          $table->unsignedInteger('votes');       // INT
          $table->unsignedMediumInteger('votes'); // MEDIUMINT
          $table->unsignedBigInteger('votes');    // BIGINT

          /**
           * Variable length character string type（可変長文字列型）
           */
          $table->string('name', 100);  // VARCHAR

          /**
           * Fixed-length character string type（固定長文字列型）
           */
          $table->char('name', 100);  // CHAR

          /**
           * TEXT type（TEXT型）
           */
          $table->text('description');        // TEXT
          $table->mediumText('description');  // MEDIUMTEXT
          $table->longText('description');    // LONGTEXT

          /**
           * BLOB（バイナリデータ）型
           */
          $table->binary('data');   // BLOB

          /**
           * Boolean型
           */
          $table->boolean('confirmed');   // BOOLEAN

          /**
           * 日時系
           */
          $table->year('birth_year');       // YEAR
          $table->date('created_at');       // DATE
          $table->dateTime('created_at');   // DATETIME
          $table->dateTimeTz('created_at'); // DATETIME/タイムゾーン付き
          $table->time('sunrise');          // TIME
          $table->timeTz('sunrise');        // TIME/タイムゾーン付き
          $table->timestamp('added_on');    // TIMESTAMP
          $table->timestampTz('added_on');  // TIMESTAMP/タイムゾーン付き

          /**
           * created_at＆updated_atカラム追加用
           */
          $table->timestamps();         // NULL値許容
          $table->nullableTimestamps(); // timestamps()と同じ
          $table->timestampsTz();       // NULL値許容/タイムゾーン付き

          /**
           * ソフトデリート用deleted_atカラム追加用/NULL値許容
           */
          $table->softDeletes();    // TIMESTAMP
          $table->softDeletesTz();  // TIMESTAMP/タイムゾーン付き

          /**
           * Geometry系
           */
          $table->geometry('positions');            // GEOMETRY
          $table->geometryCollection('positions');  // GEOMETRYCOLLECTION

          /**
           * LineString系
           */
          $table->lineString('positions');      // LINESTRING
          $table->multiLineString('positions'); // MULTILINESTRING

          /**
           * 空間系
           */
          $table->point('position');          // POINT
          $table->multiPoint('positions');    // MULTIPOINT
          $table->polygon('positions');       // POLYGON
          $table->multiPolygon('positions');  // MULTIPOLYGON

          /**
           * アドレス系
           */
          $table->ipAddress('visitor'); // IP_ADDRESS
          $table->macAddress('device'); // MAC_ADDRESS

          /**
           * Json系
           */
          $table->json('options');  // JSON
          $table->jsonb('options'); // JSONB

          /**
           * 列挙型
           */
          $table->enum('level', ['easy', 'hard']);  // ENUMカラム

          /**
           * Float系
           */
          $table->decimal('amount', 8, 2);          // DECIMAL
          $table->unsignedDecimal('amount', 8, 2);  // DECIMAL/UNSIGNED（符号なし）
          $table->double('amount', 8, 2);           // DOUBLE
          $table->float('amount', 8, 2);            // FLOAT

          /**
           * taggable_id（INTERGER/UNSIGNED）＆taggable_type（文字列）追加用
           */
          $table->morphs('taggable');
          $table->nullableMorphs('taggable'); // morphs()＋NULL値許容

          /**
           * UUIDカラム追加用
           */
          $table->uuid('id'); // UUID

          /**
           * remember_tokenカラム追加用
           */
          $table->rememberToken();  // VARCHAR(100)/NULL値許容


          /* ---------------------------------------------------------------------------- *
           * Column Qualifier List （カラム修飾子 一覧）
           * ---------------------------------------------------------------------------- */
          $table->string('name', 100)
            ->first()                       // カラム追加位置指定（テーブルの先頭）
            ->after('column')               // カラム追加位置指定（指定カラムの次）
            ->autoIncrement()               // AUTO_INCREMENT追加（整数カラムのみ）
            ->charset('utf8')               // キャラクタセット指定（MySQLのみ）
            ->collation('utf8_unicode_ci')  // コロケーション指定(MySQL/SQL Serverのみ)
            ->comment('username columns')   // コメント
            ->default('default-value')      // デフォルト値指定
            ->nullable(true)                // null許容
            ->storedAs('score * count')     // stored generatedカラム生成(MySQLのみ)
            ->unsigned()                    // 符号なし設定(整数カラム/MySQLのみ)
            ->useCurrent()                  // デフォルト値をCURRENT_TIMESTAMPへ指定（TIMESTAMP）
            ->virtualAs('TIMEDIFF(created_at, modified_at)')        // virtual generatedカラムを生成(MySQLのみ)
          ;

          /* ---------------------------------------------------------------------------- *
           * Index Qualifier List （インデックスタイプ 一覧）
           * ---------------------------------------------------------------------------- */
          $table->string('name', 100)
            ->primary('id')                 // Add primary key（主キー追加）
            ->primary(['id', 'parent_id'])  // Add compound key（複合キー追加）
            ->unique('email')               // Add unique key（uniqueキー追加）
            ->index('state')                // Add index （インデックス追加）
            ->spatialIndex('location')      // Spatial index addition [other than SQLite]（空間インデックス追加 [SQLite以外]）
          ;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Schema::dropIfExists('');
    }
}
