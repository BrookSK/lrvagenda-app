<?php
/*
 * Copyright 2014 Google Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License"); you may not
 * use this file except in compliance with the License. You may obtain a copy of
 * the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations under
 * the License.
 */

namespace Google\Service\Vision;

class GoogleCloudVisionV1p1beta1ProductSearchResultsResult extends \Google\Model
{
  public $image;
  protected $productType = GoogleCloudVisionV1p1beta1Product::class;
  protected $productDataType = '';
  public $score;

  public function setImage($image)
  {
    $this->image = $image;
  }
  public function getImage()
  {
    return $this->image;
  }
  /**
   * @param GoogleCloudVisionV1p1beta1Product
   */
  public function setProduct(GoogleCloudVisionV1p1beta1Product $product)
  {
    $this->product = $product;
  }
  /**
   * @return GoogleCloudVisionV1p1beta1Product
   */
  public function getProduct()
  {
    return $this->product;
  }
  public function setScore($score)
  {
    $this->score = $score;
  }
  public function getScore()
  {
    return $this->score;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(GoogleCloudVisionV1p1beta1ProductSearchResultsResult::class, 'Google_Service_Vision_GoogleCloudVisionV1p1beta1ProductSearchResultsResult');