j<?php

    namespace App;

    use Illuminate\Database\Eloquent\Model;

    class PersiapanPackingProduk extends Model
    {
        protected $fillable = ['bppb_id', 'user_id', 'status'];

        public function Bppb()
        {
            return $this->belongsTo(Bppb::class);
        }

        public function User()
        {
            return $this->belongsTo(User::class);
        }

        public function DetailPersiapanPackingProduk()
        {
            return $this->hasMany(DetailPersiapanPackingProduk::class, 'persiapan_id');
        }
    }
