<?php

namespace Javan;

use File;
use Illuminate\Database\Eloquent\Model;
use Image;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class Photo extends Model
{
	protected $table    = 'post_photo';
	protected $fillable = ['name', 'path', 'thumbnail_path'];
	protected $file;

	public static function fromFile(UploadedFile $file)
	{
		$photo       = new static;
		$photo->file = $file;

		$photo->fill([
			'name'           => $photo->fileName(),
			'path'           => $photo->filePath(),
			'thumbnail_path' => $photo->thumbnailPath(),
		]);

		return $photo;
	}

	public function fileName()
	{
		$name = sha1($this->file->getClientOriginalName());

		$extension = $this->file->getClientOriginalExtension();

		return "{$name}.{$extension}";
	}

	public function filePath()
	{
		return $this->baseDir() . '/' . $this->fileName();
	}

	public function baseDir()
	{
		return 'images/posts';
	}

	public function thumbnailPath()
	{
		return $this->baseDir() . '/tn-' . $this->fileName();
	}

	public function post()
	{
		return $this->belongsTo(Post::class);
	}

	public function upload()
	{
		$this->file->move($this->baseDir(), $this->fileName());
		$this->makeThumbnail();

		return $this;
	}

	public function makeThumbnail()
	{
		Image::make($this->filePath())->fit(200)->save($this->thumbnailPath());

		return $this;
	}

	public function delete()
	{
		parent::delete();

		File::delete([
			$this->path,
			$this->thumbnail_path,
		]);
	}
}