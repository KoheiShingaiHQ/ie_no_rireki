<?php

use Illuminate\Database\Seeder;

class GroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('groups')->insert([
            [
                'id' => 1,
                'category' => 'division',
                'name' => 'プロダクト事業部',
                'created_at' => date("Y-m-d H:i:s")
            ], [
                'id' => 2,
                'category' => 'division',
                'name' => 'SI事業部',
                'created_at' => date("Y-m-d H:i:s")
            ], [
                'id' => 3,
                'category' => 'division',
                'name' => '業務推進本部',
                'created_at' => date("Y-m-d H:i:s")
            ], [
                'id' => 4,
                'category' => 'division',
                'name' => '所属なし',
                'created_at' => date("Y-m-d H:i:s")
            ], [
                'id' => 5,
                'category' => 'affiliation',
                'name' => 'ソリューション部',
                'created_at' => date("Y-m-d H:i:s")
            ], [
                'id' => 6,
                'category' => 'affiliation',
                'name' => '製品開発部',
                'created_at' => date("Y-m-d H:i:s")
            ], [
                'id' => 7,
                'category' => 'affiliation',
                'name' => '事業企画部',
                'created_at' => date("Y-m-d H:i:s")
            ], [
                'id' => 8,
                'category' => 'affiliation',
                'name' => '営業本部',
                'created_at' => date("Y-m-d H:i:s")
            ], [
                'id' => 9,
                'category' => 'affiliation',
                'name' => 'ソリューション本部',
                'created_at' => date("Y-m-d H:i:s")
            ], [
                'id' => 10,
                'category' => 'affiliation',
                'name' => 'システム開発本部',
                'created_at' => date("Y-m-d H:i:s")
            ], [
                'id' => 11,
                'category' => 'affiliation',
                'name' => 'プロジェクト管理室',
                'created_at' => date("Y-m-d H:i:s")
            ], [
                'id' => 12,
                'category' => 'affiliation',
                'name' => 'パートナー推進グループ',
                'created_at' => date("Y-m-d H:i:s")
            ], [
                'id' => 13,
                'category' => 'affiliation',
                'name' => '営業支援グループ',
                'created_at' => date("Y-m-d H:i:s")
            ], [
                'id' => 14,
                'category' => 'affiliation',
                'name' => '人事総務グループ',
                'created_at' => date("Y-m-d H:i:s")
            ], [
                'id' => 15,
                'category' => 'affiliation',
                'name' => '所属なし',
                'created_at' => date("Y-m-d H:i:s")
            ], [
                'id' => 16,
                'category' => 'department',
                'name' => 'サービスソリューション部',
                'created_at' => date("Y-m-d H:i:s")
            ], [
                'id' => 17,
                'category' => 'department',
                'name' => 'アドバンスド・ビジネスソリューション部',
                'created_at' => date("Y-m-d H:i:s")
            ], [
                'id' => 18,
                'category' => 'department',
                'name' => 'ビジネスインキュベーション部',
                'created_at' => date("Y-m-d H:i:s")
            ], [
                'id' => 19,
                'category' => 'department',
                'name' => 'テクニカルソリューション部',
                'created_at' => date("Y-m-d H:i:s")
            ], [
                'id' => 20,
                'category' => 'department',
                'name' => '第1部',
                'created_at' => date("Y-m-d H:i:s")
            ], [
                'id' => 21,
                'category' => 'department',
                'name' => '第2部',
                'created_at' => date("Y-m-d H:i:s")
            ], [
                'id' => 22,
                'category' => 'department',
                'name' => '第3部',
                'created_at' => date("Y-m-d H:i:s")
            ], [
                'id' => 23,
                'category' => 'department',
                'name' => '第4部',
                'created_at' => date("Y-m-d H:i:s")
            ], [
                'id' => 24,
                'category' => 'department',
                'name' => 'プロジェクト推進部',
                'created_at' => date("Y-m-d H:i:s")
            ], [
                'id' => 25,
                'category' => 'department',
                'name' => '福岡開発センター',
                'created_at' => date("Y-m-d H:i:s")
            ], [
                'id' => 26,
                'category' => 'department',
                'name' => '所属なし',
                'created_at' => date("Y-m-d H:i:s")
            ]
        ]);
    }
}
